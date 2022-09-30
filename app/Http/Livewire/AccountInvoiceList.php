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
    protected $listeners = ['refreshComponent' => '$refresh'];


    public function getInvoices()
    {
        $this->invoices = Accounts::find($this->account)->invoices;
    }

    public function downloadInvoice($id, $account) {

        $accountName = Accounts::select('first_name','last_name')->where('id', $account)->get();
        $accountNameRender = $accountName->collect();
        $currentDate = Carbon::now()->format('M-Y');

        $fullString = 'invoice-'. $accountNameRender[0]['first_name'] .'-'. $accountNameRender[0]['last_name'] .'-'. $currentDate .'';


        $invoices = Invoice::find($id);
        $pdf = PDF::loadView('pdf', compact('invoices'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download($fullString . '.pdf');
    }

    public function render()
    {
        $this->getInvoices();
        return view('livewire.account-invoice-list');
    }
}
