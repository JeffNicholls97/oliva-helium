<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Livewire\Component;

class SettingsInvoiceEmailTemplate extends Component
{
    public $email_template;
    public $setting;

    public function getSettings()
    {
        $this->setting = Setting::query()->where('id', 1)->first();
    }

    public function populateInput()
    {
        if($this->setting->invoice_email_template) {
            $this->email_template = $this->setting->invoice_email_template;
        }
    }

    public function InvoiceEmailTemplate()
    {
        $this->setting->invoice_email_template = $this->email_template;
        $this->setting->save();
    }

    public function render()
    {
        $this->getSettings();
        $this->populateInput();
        return view('livewire.settings-invoice-email-template');
    }
}
