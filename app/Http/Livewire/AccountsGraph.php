<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use DateTime;

class AccountsGraph extends Component
{
    public $graphData;
    public $timeLength = 30;
    public $account;
    public $address;
    // public $isLoading = true;
    public $graphValues;
    public $coinvalue;
    public $minTime;
    public $maxTime;

    public function requestMinerTransactionsForAccount()
    {
        $this->minTime = Carbon::now()->subDays($this->timeLength)->toDateString();
        $this->maxTime = Carbon::now()->toDateString();

        //https://api.helium.io/v1/hotspots/112R5uqL1QN5tq7hJgR4kgFVb5V214u9EMLUoCc7eiiqao515z7V/rewards
        //?min_time='. $this->minTime .'
        //&max_time='. $this->maxTime .'
        //&cursor=eyJ0eG4iOiJXM1ZfT3R6akxXMHY0eVBQMjBRcnB3dDZvbVNGeFNhUlkzQjV6OFFwb01JIiwiZW5kX2Jsb2NrIjoxNDMzNTg2LCJibG9jayI6MTQ2MjIzMiwiYW5jaG9yX2Jsb2NrIjoxNDcxMzAwfQ

        $response = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
        ])->get('https://api.helium.io/v1/hotspots/'. $this->address['address_key'] .'/rewards/sum?min_time='. $this->minTime .'&max_time='. $this->maxTime .'&bucket=day');

        $coinResponse = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
        ])->get('https://api.coingecko.com/api/v3/simple/price?ids=helium&vs_currencies=gbp');

        $responseData = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
        ])->get('https://api.helium.io/v1/hotspots/'. $this->address['address_key'] .'/rewards/sum?min_time='. $this->minTime .'&max_time='. $this->maxTime .'');

        if ($response->status() && $responseData->status()){
            $this->graphData = $response->collect();
            $this->graphValues = $responseData->collect();
        }

    }

    public function render()
    {
        $this->requestMinerTransactionsForAccount();
        return view('livewire.accounts-graph');
    }
}
