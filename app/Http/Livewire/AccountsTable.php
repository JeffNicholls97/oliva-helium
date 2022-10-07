<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use App\Models\Accounts;
use App\Models\Setting;
use Livewire\WithFileUploads;

class AccountsTable extends Component
{
    public $accounts;
    public $currentCoinValue;
    public $startDate;
    public $endDate;
    public $bucketArray = [];
//    public $isLoadingBucket = true;
    public $heliumPrice;
    public $editModal = false;
    public $editData;
    public $profilePicture;
    public $firstName;
    public $lastName;
    public $address;
    public $emailAddress;
    public $accountKey;
    public $cash = 1;

    public function renderTable()
    {
        $this->accounts = Accounts::all();
    }

    public function overallHeliumUsingCalender()
    {
//        $this->isLoadingBucket = true;
        if($this->startDate == null && $this->endDate == null) {
            $this->startDate = Carbon::now()->subDays(30)->toDateString();
            $this->endDate = Carbon::now()->addDays(1)->toDateString();
        }

        $this->bucketArray = [];
        foreach($this->accounts as $account) {
            $addressKey = $account->address_key;

            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
            ])->retry(3)->get('https://api.helium.io/v1/hotspots/'. $addressKey .'/rewards/sum?max_time='. $this->endDate .'&min_time='. $this->startDate .'');

            if($response->status() == 200) {
                $fomrattedResponse = $response->collect();
                array_push($this->bucketArray, $fomrattedResponse);
            }
        }
//        $this->isLoadingBucket = false;
    }


    public function currentValue()
    {
//        $coinResponse = Http::withHeaders([
//            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
//        ])->get('https://api.coingecko.com/api/v3/simple/price?ids=helium&vs_currencies=gbp');
//
//        if ($coinResponse->status() == 200){
//            $this->currentCoinValue = number_format($coinResponse['helium']['gbp'], 2);
//        }

        $settings = Setting::query()->where('id', 1)->first();
        $this->heliumPrice = $settings->helium_price_gbp;

    }

    public function deleteAccountData($id)
    {
        Accounts::find($id)->delete();
        session()->flash('message', 'Data deleted successfully.');
    }

    public function closeModal()
    {
        $this->editModal = false;
    }

    public function editAccountData($id)
    {
        $this->editData = Accounts::where('id',$id)->first();
        $this->editModal = true;

        $this->profilePicture = $this->editData->account_image;
        $this->firstName = $this->editData->first_name;
        $this->lastName = $this->editData->last_name;
        $this->address = $this->editData->housing_address;
        $this->emailAddress = $this->editData->email_address;
        $this->accountKey = $this->editData->address_key;
        $this->cash = $this->editData->cash;
    }

    public function saveAccountData()
    {
//        $filenameWithExt = $this->profilePicture->getClientOriginalName();
//        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
//        $extension = $this->profilePicture->getClientOriginalExtension();
//        $fileNameToStore = $filename.'_'.time().'.'.$extension;
//        $path = $this->profilePicture->storeAs(public_path('images'),$fileNameToStore ,'real_public' );


        $this->editData->update([
            'account_image' => 'fix',
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'housing_address' => $this->address,
            'email_address' => $this->emailAddress,
            'address_key' => $this->accountKey,
            'cash' => $this->cash
        ]);

        $this->editModal = false;
        $this->reset();
    }

    public function render()
    {
        $this->renderTable();
        $this->currentValue();
        $this->overallHeliumUsingCalender();
        return view('livewire.accounts-table');
    }
}
