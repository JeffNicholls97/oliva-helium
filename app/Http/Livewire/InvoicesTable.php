<?php

namespace App\Http\Livewire;

use App\Models\Accounts;
use App\Models\Invoice;
use App\Models\Setting;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class InvoicesTable extends Component
{

    public $accountId;
    public $invoices;
    public $account;
    public $emailModal = false;
    public $editEmailData = [];
    public $emailSubject;
    public $emailBody;
    public $link;
    public $submitMessage = 'Send Invoice';

    public function renderTable()
    {
        $this->invoices = Invoice::all();
        $this->account = Accounts::all();
    }

    public function openEmailModal($id, $invoiceId) {
        $this->emailModal = true;
        $this->submitMessage = 'Send Invoice';
        $this->editEmailData = Accounts::where('id',$id)->first();
        $invoice = Invoice::where('id',$invoiceId)->first();

        $sumArr = [];
        foreach($invoice->invoice_data as $key => $invoiceEarn) {
            if(array_key_exists('amount', $invoiceEarn)) {
                array_push($sumArr, $invoiceEarn['amount']);
                $estimatedTotal = array_sum($sumArr);
                $estimatedTotalFinal = $estimatedTotal / 100000000;
            }
        }

        $string = $this->editEmailData->miner_name;
        $minerName = str_replace("-", " ", $string);

        $currentDate =  Carbon::parse($invoice->invoice_date)->format('F - Y');

        $this->emailSubject = ''. ucwords($minerName) .' Invoice for '. $currentDate .'.';
        $email_template = Setting::query()->where('id', 1)->first()->invoice_email_template;

        // replace method:
        //$newFormatted  = str_replace("[first_name]", $this->editEmailData->first_name, $email_template);
        $newFormatted = str_replace(
            array("[first_name]","[last_name]","[miner_name]","[customer_hnt]","[house_address]","[invoice_date]"),
            array($this->editEmailData->first_name, $this->editEmailData->last_name, $minerName, $estimatedTotalFinal / 2, $this->editEmailData->housing_address, $currentDate),
            $email_template
        );

        $this->emailBody = $newFormatted;
    }

    public function sendEmail($accountId) {
        $invoice = Invoice::where('accounts_id',$accountId)->first();

        $this->link = $invoice->invoice_link;

        Mail::send('emails.invoice_email',
            array(
                'body' => $this->emailBody,
            ),
            function($message){
                $message->from('dan.mcgee@oliva.network');
                $message->attach($this->link);
                $message->to($this->editEmailData->email_address, 'invoice')->subject($this->emailSubject);
            }
        );

        $this->submitMessage = 'Invoice Sent Successfully';
    }

    public function deleteInvoice($id)
    {
        Invoice::find($id)->delete();
    }

    public function render()
    {
        $this->renderTable();
        return view('livewire.invoices-table');
    }
}
