<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Accounts;

class AccountsAdd extends Component
{
    public $firstName;
    public $lastName;
    public $address;
    public $emailAddress;
    public $accountKey;
    public $cash = false;

    public function submitAccountData()
    {
        Accounts::create([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'housing_address' => $this->address,
            'email_address' => $this->emailAddress,
            'address_key' => $this->accountKey,
            'cash' => $this->cash
        ]);
    }

    public function render()
    {
        return view('livewire.accounts-add');
    }
}
