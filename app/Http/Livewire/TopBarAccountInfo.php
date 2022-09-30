<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class TopBarAccountInfo extends Component
{
    public $hotspotCount;
    public $hotspotBalance;
    public $hotspotBalanceGbp;
    public $isLoadingAccount = true;

    public function AccountInformationStats()
    {
        $response = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
        ])->get('https://api.helium.io/v1/accounts/14Ve5BGUKRGxiXkqm329KRs3JepWpuBCBqfwbNZdGMipjavoyq6');

        $coinResponse = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
        ])->get('https://api.coingecko.com/api/v3/simple/price?ids=helium&vs_currencies=gbp');

        if ($response->status() && $coinResponse->status() == 200){
            $heliumAccount = $response->collect();
            $this->hotspotCount = $heliumAccount['data']['hotspot_count'];

            $numberData = (int)$heliumAccount['data']['balance'];
            $convertedNumber = $numberData / 100000000;
            $this->hotspotBalance = number_format($convertedNumber, 2);

            $currentRate = number_format($coinResponse['helium']['gbp'], 2);
            $rateFloat = floatval($currentRate);


            $this->hotspotBalanceGbp = $numberData * $rateFloat / 100000000 ;

            $this->isLoadingAccount = false;
        }

    }

    public function render()
    {
        return view('livewire.top-bar-account-info');
    }
}
