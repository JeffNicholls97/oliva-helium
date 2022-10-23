<?php

namespace App\Http\Livewire;

use App\Models\Accounts;
use App\Models\Setting;
use Livewire\Component;

class DashboardAccounts extends Component
{

    public function renderTable()
    {
        $this->accounts = Accounts::all();
    }

    public function render()
    {
        $this->renderTable();
        return view('livewire.dashboard-accounts');
    }
}
