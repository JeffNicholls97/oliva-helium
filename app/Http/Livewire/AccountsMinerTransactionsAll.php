<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use App\Models\Accounts;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use DateTime;
use PDF;

class AccountsMinerTransactionsAll extends Component
{
    public $account;
    public $address;
    public $startDate;
    public $endDate;
    public $cursor;
    public $newTran;
    public $convertedTimestamp;
    public $coinvalue;
    public $estimatedTotal;
    public $fullInvoiceDataArray;
    public $priceSold;
    public $lastActiveTime;

    public function requestMinerTransactionsForAccountCalenderInput()
    {
        if($this->startDate == null && $this->endDate == null) {
            $this->startDate = Carbon::now()->subDays(1)->toDateString();
            $this->endDate = Carbon::now()->addDays(1)->toDateString();
        }

        $response = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
        ])->retry(3, 1000)->get('https://api.helium.io/v1/hotspots/'. $this->address['address_key'] .'/rewards?max_time='. $this->endDate .'&min_time='. $this->startDate .'');

        if ($response->status() == 200){
            $transactions = $response->collect();
            $transactionArray = [];
            if (isset($transactions['cursor']))
            {
                $transactionCursor = $transactions['cursor'];
                $baseUrl = 'https://api.helium.io/v1/hotspots/'. $this->address['address_key'] .'/rewards?max_time='. $this->endDate .'&min_time='. $this->startDate .'';
                do {
                    $responseNew = Http::withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
                    ])->get($baseUrl.'&cursor='.$transactionCursor.'');
                    if ($responseNew->status() == 200) {
                        $responseTest = $responseNew->json();
                        if (array_key_exists('cursor', $responseTest)) {
                            $transactionCursor = $responseTest['cursor'];
                            $transactionArray['cursor'] = $responseTest['cursor'];
                        }
                        if(in_array(isset($transactionCursor), $transactionArray)){
                            foreach($responseTest['data'] as $dataline) {
                                array_push($transactionArray, $dataline);
                            }
                        }
                        sleep(1);
                    }
                }
                while(isset($responseTest['cursor']) && in_array(isset($transactionCursor), $transactionArray));
            }else {
                $responseNew = Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
                ])->get('https://api.helium.io/v1/hotspots/'. $this->address['address_key'] .'/rewards?max_time='. $this->endDate .'&min_time='. $this->startDate .'');
            }

            if($responseNew->status() == 200) {
                $responseNull = $responseNew->collect();
                if($transactionArray) {
                    unset($transactionArray['cursor']);
                    $this->lastActiveTime = $transactionArray[0]['timestamp'];
                    $this->newTran = $transactionArray;
                }elseif($responseNull['data']){
                    $noCursor = $responseNew->collect();
                    $this->lastActiveTime = $noCursor['data'][0]['timestamp'];

                    $this->newTran = $noCursor['data'];
                }else{
                    $this->inactiveMiner();
                }
            }
        }
    }

    public function inactiveMiner()
    {
        $this->newTran['data']['errorCode'] = 'Miner is inactive';
    }

    public function fullDataToPass()
    {
        $this->fullInvoiceDataArray = array();
        foreach ($this->newTran as $key => $transaction) {
            $block = $transaction['block'];

            $blockResponse = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
            ])->retry(10, 3000)->get('https://api.helium.io/v1/oracle/prices/'. $block .'');

            if($blockResponse->status() == 200) {
                $blockConverted = $blockResponse->json();
                if(array_key_exists('price', $blockConverted['data'])) {
                    $transaction['price'] = $blockConverted['data']['price'];
                }else{
                    $transaction['price'] = 'No Price Saved at current block';
                }
            }
            $this->fullInvoiceDataArray[$key] = $transaction;
        }
        $addressResponse = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
        ])->retry(3, 1000)->get('https://api.helium.io/v1/hotspots/'.$this->address['address_key'].'');
        if($addressResponse->status() == 200) {
            $addressConverted = $addressResponse->json();
            $this->fullInvoiceDataArray['miner-info'] = $addressConverted;
        }
        $conversionResponse = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
        ])->get('https://cdn.jsdelivr.net/gh/fawazahmed0/currency-api@1/latest/currencies/eur/gbp.json');

        if($conversionResponse->status() == 200) {
            $conversionConverted = $conversionResponse->json();
            $GBP_price = $conversionConverted['gbp'];

            $this->fullInvoiceDataArray['miner-info']['gbp-conversion'] = $GBP_price;
        }
    }

    public function generateSingleInvoice()
    {
        if($this->startDate == null && $this->endDate == null) {
            $this->startDate = Carbon::now()->subDays(1)->toDateString();
            $this->endDate = Carbon::now()->addDays(1)->toDateString();
        }
        $this->fullDataToPass();
        $this->fullInvoiceDataArray['miner-info']['price-sold'] = $this->priceSold;
        $formatData = $this->fullInvoiceDataArray;

        $accountCash = Accounts::where('id', $this->account)->first();

        //$invoiceDate = Carbon::parse($this->startDate)->format('F - Y');


        $invoice = Invoice::create([
            'accounts_id' => $this->account,
            'invoice_link'  => '/test',
            'cash' => $accountCash->cash,
            'invoice_data' => $formatData,
            'invoice_date' => $this->startDate
        ]);

        $this->emit('refreshComponent');

    }

    public function render()
    {
        $this->requestMinerTransactionsForAccountCalenderInput();
        return view('livewire.accounts-miner-transactions-all');
    }
}
