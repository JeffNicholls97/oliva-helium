<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class TopBarStats extends Component
{
    public $isLoadingStats = true;
    public $heliumStats;
    public $coinPrice;
    public $heliumPrice;

    public function getCurrentCoinInfo()
    {
//        $coinResponse = Http::withHeaders([
//            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
//        ])->get('https://api.coingecko.com/api/v3/simple/price?ids=helium&vs_currencies=gbp');
//
//        if ($coinResponse->status() == 200){
//            $this->heliumStats = $coinResponse->collect();
//            $this->coinPrice = number_format($this->heliumStats['helium']['gbp'], 2);
//
//        }

        $settings = Setting::query()->where('id', 1)->first();
        $this->heliumPrice = $settings->helium_price_gbp;
        $this->isLoadingStats = false;
    }


    public function render()
    {
        return view('livewire.top-bar-stats');
    }
}
