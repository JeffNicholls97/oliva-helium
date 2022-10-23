<?php

namespace App\Http\Livewire;

use App\Models\Accounts;
use App\Models\Invoice;
use Livewire\Component;

class DashboardInvoices extends Component
{
    public function renderTable()
    {
        $this->invoices = Invoice::all();
        $this->account = Accounts::all();
    }

    public function render()
    {
        $this->renderTable();
        return view('livewire.dashboard-invoices');
    }
}
