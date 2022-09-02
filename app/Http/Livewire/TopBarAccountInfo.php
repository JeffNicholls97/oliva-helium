<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class TopBarAccountInfo extends Component
{
    public $hotspotCount;
    public $hotspotBalance;
    public $isLoadingAccount = true;

    public function AccountInformationStats()
    {
        $response = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
        ])->get('https://api.helium.io/v1/accounts/14Ve5BGUKRGxiXkqm329KRs3JepWpuBCBqfwbNZdGMipjavoyq6');

        if ($response->status() == 200){
            $heliumAccount = $response->collect();
            $this->hotspotCount = $heliumAccount['data']['hotspot_count'];
            
            $this->hotspotBalance = (int)$heliumAccount['data']['balance'];
            $this->isLoadingAccount = false;
        }

    }

    public function render()
    {
        return view('livewire.top-bar-account-info');
    }
}
