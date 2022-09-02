<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Accounts;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use DateTime;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;

class AccountMetrics extends Component
{
    public $account;
    public $address;
    public $accountStats;
    public $lastActiveTimeBox;
    public $isLoadingAccountStats = true;
    public $minTime;
    public $maxTime;
    public $coinvalue;

    public function mount($accountProfile)
    {
        $this->account = $accountProfile;
    }

    public function getAddressFromAccount()
    {
        $this->address = Accounts::where('id', $this->account)->get()->first();
    }

    public function getCurrentHntCoinValue()
    {
        $coinResponse = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
        ])->get('https://api.coingecko.com/api/v3/simple/price?ids=helium&vs_currencies=gbp');

        if ($coinResponse->status() == 200){
            $this->coinvalue = $coinResponse->collect();
        }
    }

    public function requestHotspotStats()
    {
        $response = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
        ])->get('https://api.helium.io/v1/hotspots/'. $this->address['address_key'] .'');

        if ($response->status() == 200){
            $this->accountStats = $response->collect();
            
            $date = date("Y-m-d g:i:s a", strtotime($this->accountStats['data']['timestamp_added']));
            $dateNew = Carbon::parse($date)->diffForHumans();


            $this->lastActiveTimeBox = $dateNew;
            $this->isLoadingAccountStats = false;
        }
    }

    public function render()
    {
        $this->getAddressFromAccount();
        $this->getCurrentHntCoinValue();
        return view('livewire.account-metrics');
    }
}
