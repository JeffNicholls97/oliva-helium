<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class TopBarAccountInfo extends Component
{
    public $hotspotCount;
    public $hotspotBalance;
    public $hotspotBalanceGbp;
    public $isLoadingAccount = true;
    public $heliumPrice;

    public function AccountInformationStats()
    {

        $settings = Setting::query()->where('id', 1)->first();
        $this->heliumPrice = $settings->helium_price_gbp;

        $this->hotspotCount = $settings->total_miners;

        $numberData = $settings->total_account_hnt;
        $convertedNumber = $numberData / 100000000;
        $this->hotspotBalance = number_format($convertedNumber, 2);

        $currentRate = number_format($this->heliumPrice, 2);
        $rateFloat = floatval($currentRate);


        $this->hotspotBalanceGbp = $numberData * $rateFloat / 100000000 ;

        $this->isLoadingAccount = false;

    }

    public function render()
    {
        return view('livewire.top-bar-account-info');
    }
}
