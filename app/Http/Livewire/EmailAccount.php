<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use App\Models\Accounts;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class EmailAccount extends Component
{
    public $accounts;
    public $accountEmailId = 1;
    public $emailBody;
    public $hotspotKey;
    public $hotspotName;
    public $accountEmail;
    public $submitMessage = 'Send Introduction Email';

    public function fillIntro()
    {
        $this->submitMessage = 'Send Introduction Email';
        $email_template = Setting::query()->where('id', 1)->first()->intro_email_template;

        $account = Accounts::query()->where('id', $this->accountEmailId)->first();

        $string = $account->miner_name;
        $minerName = str_replace("-", " ", $string);

        $this->hotspotKey = $account->address_key;
        $this->hotspotName = $minerName;
        $this->accountEmail = $account->email_address;

        $newFormatted = str_replace(
            array("[first_name]","[last_name]","[miner_name]"),
            array($account->first_name, $account->last_name, $minerName),
            $email_template
        );

        $this->emailBody = $newFormatted;
    }

    public function sendEmailIntro()
    {
        Mail::send('emails.email_intro',
            array(
                'body' => $this->emailBody,
                'hotspotKey' => $this->hotspotKey,
                'hotspotName' => $this->hotspotName,
            ),
            function($message){
                $message->from('dan.mcgee@oliva.network');
                $message->attach('/var/www/html/public/introPDF/CoinbaseTutorial.pdf');
                $message->attach('/var/www/html/public/introPDF/HNTTutorial.pdf');
                $message->attach('/var/www/html/public/introPDF/Oliva-StarterPack.pdf');
                $message->to($this->accountEmail, 'intro')->subject('Welcome to Oliva!');
            }
        );

        $this->submitMessage = 'Sent Successfully';
    }

    public function render()
    {
        $this->fillIntro();
        return view('livewire.email-account');
    }
}
