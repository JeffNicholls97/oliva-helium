<?php

namespace App\Http\Livewire;

use App\Models\Accounts;
use Livewire\Component;

class DashboardLeaderboard extends Component
{
    public function renderTable()
    {
        $this->accounts = Accounts::all();
    }

    public function render()
    {
        $this->renderTable();
        return view('livewire.dashboard-leaderboard');
    }
}
