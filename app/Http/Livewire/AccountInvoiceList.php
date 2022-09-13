<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Invoice;
use App\Models\Accounts;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use DateTime;
use PDF;

class AccountInvoiceList extends Component
{
    public $invoices;
    public $account;
    public $address;

    public function getInvoices()
    {
        $this->invoices = Accounts::find($this->account)->invoices;
    }

    public function downloadInvoice($id) {
        $invoices = Invoice::find($id);
        $pdf = PDF::loadView('pdf', compact('invoices'));
        return $pdf->download('test.pdf');
    }

    public function render()
    {
        $this->getInvoices();
        return view('livewire.account-invoice-list');
    }
}
