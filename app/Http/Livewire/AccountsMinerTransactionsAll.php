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
                $responseNew = Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
                ])->get('https://api.helium.io/v1/hotspots/'. $this->address['address_key'] .'/rewards?max_time='. $this->endDate .'&min_time='. $this->startDate .'&cursor='.$transactionCursor.'');
            }else {
                $responseNew = Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
                ])->get('https://api.helium.io/v1/hotspots/'. $this->address['address_key'] .'/rewards?max_time='. $this->endDate .'&min_time='. $this->startDate .'');
            }

            if($responseNew->status() == 200) {
                $this->newTran = $responseNew->collect();
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
