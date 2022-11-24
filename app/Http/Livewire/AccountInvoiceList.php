<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
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

        $accountName = Accounts::select('miner_name')->where('id', $account)->first();
        $currentDate = Invoice::select('invoice_date')->where('id', $id)->first();
        $makeDate = strtotime($currentDate['invoice_date']);
        $newDateformat = date('M-Y',$makeDate);

        $fullString = 'invoice-'. $accountName->miner_name .'-'. $newDateformat .'';


        $invoices = Invoice::find($id);
        $accountPass = Accounts::where('id', $account)->first();
        $invoiceLink = Invoice::where('id', $id)->first();


        $pdf = PDF::loadView('pdf', compact('invoices', 'accountPass'));
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();
        $content = $pdf->download();
        Storage::disk('real_public')->put('pdf/'. $fullString .'.pdf',$content);
        $path = Storage::disk('real_public')->path('pdf/'. $fullString .'.pdf');
        $invoiceLink->update([
            'invoice_link' => $path,
        ]);
        return $pdf->download($fullString . '.pdf');
    }

    public function viewPDF($id)
    {
        $invoices = Invoice::find($id);
        return view('pdf')->with('invoices', $invoices);
    }

    public function render()
    {
        $this->getInvoices();
        return view('livewire.account-invoice-list');
    }
}
