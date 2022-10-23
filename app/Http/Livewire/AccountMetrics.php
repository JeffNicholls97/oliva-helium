<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Livewire\Component;
use App\Models\Accounts;
use App\Models\Invoice;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use DateTime;

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
    public $totalInvoices;
    public $minerCity;
    public $minerScale;
    public $minerStatus;

    public function mount($accountProfile)
    {
        $this->account = $accountProfile;
    }

    public function getAddressFromAccount()
    {
        $this->address = Accounts::where('id', $this->account)->get()->first();
    }

    public function invoiceCount()
    {
        $invoices = Accounts::find($this->account)->invoices;

        $this->totalInvoices = count($invoices);
    }

    public function getCurrentHntCoinValue()
    {
        $settings = Setting::query()->where('id', 1)->first();
        $this->coinvalue = $settings->helium_price_gbp;
    }

    public function requestHotspotStats()
    {
        $settings = Accounts::query()->where('id', $this->account)->first();

        $this->minerCity = $settings->miner_city;
        $this->minerStatus = $settings->miner_status;
        $this->minerScale = (float) $settings->miner_scale;

        $this->isLoadingAccountStats = false;
    }

    public function render()
    {
        $this->getAddressFromAccount();
        $this->getCurrentHntCoinValue();
        $this->invoiceCount();
        return view('livewire.account-metrics');
    }
}
