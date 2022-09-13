<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
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

    public function requestMinerTransactionsForAccountCalenderInput()
    {
        if($this->startDate == null && $this->endDate == null) {
            $this->startDate = Carbon::now()->subDays(1)->toDateString();
            $this->endDate = Carbon::now()->addDays(1)->toDateString();
        }

        $response = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
        ])->get('https://api.helium.io/v1/hotspots/'. $this->address['address_key'] .'/rewards?max_time='. $this->endDate .'&min_time='. $this->startDate .'');

        if ($response->status() == 200){
            $transactions = $response->collect();
            if (isset($transactions['cursor']))
            {
                $transactionCursor = $transactions['cursor'];
                $baseUrl = 'https://api.helium.io/v1/hotspots/'. $this->address['address_key'] .'/rewards?max_time='. $this->endDate .'&min_time='. $this->startDate .'';
                $transactionArray = [];
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
                if($transactionArray) {
                    unset($transactionArray['cursor']);
                    $this->newTran = $transactionArray;

                    //dd($this->newTran);
                }else{
                    $noCursor = $responseNew->collect();
                    $this->newTran = $noCursor['data'];
                }


            }
        }

    }

    public function generateSingleInvoice()
    {
        if($this->startDate == null && $this->endDate == null) {
            $this->startDate = Carbon::now()->subDays(1)->toDateString();
            $this->endDate = Carbon::now()->addDays(1)->toDateString();
        }

        $formatData = $this->newTran;

        $invoice = Invoice::create([
            'accounts_id' => $this->account,
            'invoice_link'  => '/test',
            'cash' => true,
            'invoice_data' => $formatData
        ]);
    }

    public function render()
    {
        $this->requestMinerTransactionsForAccountCalenderInput();
        return view('livewire.accounts-miner-transactions-all');
    }
}
