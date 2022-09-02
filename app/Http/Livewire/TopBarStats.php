<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class TopBarStats extends Component
{
    public $isLoadingStats = true;
    public $heliumStats;
    public $CoinPrice;

    public function getCurrentCoinInfo()
    {
        $response = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
        ])->get('https://api.helium.io/v1/stats');

        if ($response->status() == 200){
            $this->heliumStats = $response->collect();
            $this->coinPrice = number_format($this->heliumStats['data']['counts']['coingecko_price_gbp'], 2) / 100;
            $this->isLoadingStats = false;
        }
    }


    public function render()
    {
        return view('livewire.top-bar-stats');
    }
}
