<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SettingsApiStatus extends Component
{
    public $coinGeckoStatus;
    public $coinMarketStatus;

    public function checkCoinStatus()
    {
        $coinResponseGecko = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
        ])->get('https://api.coingecko.com/api/v3/ping');

        $coinResponseMarket = Http::withHeaders([
            'Accepts' => 'application/json',
            'X-CMC_PRO_API_KEY' => '1a943e6d-687b-4bc7-b722-eaf3c7634788',
        ])->get('https://pro-api.coinmarketcap.com/v1/key/info');

        if($coinResponseGecko->status() || $coinResponseMarket->status() == 200) {
            $this->coinGeckoStatus = $coinResponseGecko->json();
            $this->coinMarketStatus = $coinResponseMarket->json();
        }else{
            $this->coinGeckoStatus = 'Offline';
            $this->coinMarketStatus = 'Offline';
        }
    }

    public function render()
    {
        //$this->checkCoinStatus();
        return view('livewire.settings-api-status');
    }
}
