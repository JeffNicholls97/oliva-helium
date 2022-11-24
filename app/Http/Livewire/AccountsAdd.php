<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Accounts;
use Livewire\WithFileUploads;

class AccountsAdd extends Component
{
    use WithFileUploads;
    public $profilePicture;
    public $firstName;
    public $lastName;
    public $address;
    public $emailAddress;
    public $accountKey;
    public $cash = 1;

    public function submitAccountData()
    {

        if(!empty($this->profilePicture)){
            $filenameWithExt = $this->profilePicture->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $this->profilePicture->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $this->profilePicture->storeAs(public_path('images'),$fileNameToStore ,'real_public' );
        }else {
            $path = asset('images/user-default.png');
        }




        Accounts::create([
            'account_image' => $path,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'housing_address' => $this->address,
            'email_address' => $this->emailAddress,
            'address_key' => $this->accountKey,
            'cash' => $this->cash,
            'order' => 0
        ]);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.accounts-add');
    }
}
