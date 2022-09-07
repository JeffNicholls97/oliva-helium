<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Invoice;
use App\Models\Accounts;

class AccountInvoiceList extends Component
{
    public $invoices;
    public $account;

    public function getInvoices() 
    {
        $this->invoices = Accounts::find($this->account)->invoices;
    }

    public function generateSingleInvoice()
    {
        $test = [
            'title' => 'test',
            'data' => [
                '1' => 'One',
                '2' => 'Two',
                '3' => 'Three'
            ]
        ];

        $invoice = Invoice::create([
            'accounts_id' => $this->account,
            'invoice_link'  => '/test',
            'cash' => true,
            'invoice_data' => json_encode($test)
        ]);
    }

    public function render()
    {
        $this->getInvoices();
        return view('livewire.account-invoice-list');
    }
}
