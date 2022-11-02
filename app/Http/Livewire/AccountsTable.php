<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use App\Models\Accounts;
use App\Models\Setting;
use App\Models\Invoice;
use Livewire\WithFileUploads;

class AccountsTable extends Component
{
    use WithFileUploads;
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
    public $cash;
    public $cashTotal = [];
    public $coinvalue;
    public $invoices;
    public $invoiceDate;
    public $returnDate;

    public function renderTable()
    {
        $this->accounts = Accounts::all();
    }

//    public function overallHeliumUsingCalender()
//    {
////        $this->isLoadingBucket = true;
//        if($this->startDate == null && $this->endDate == null) {
//            $this->startDate = Carbon::now()->subDays(1)->toDateString();
//            $this->endDate = Carbon::now()->addDays(1)->toDateString();
//        }
//
//        $this->bucketArray = [];
//        $this->cashTotal = [];
//        foreach($this->accounts as $account) {
//            $addressKey = $account->address_key;
//
//            $response = Http::withHeaders([
//                'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
//            ])->retry(3, 5000)->get('https://api.helium.io/v1/hotspots/'. $addressKey .'/rewards/sum?max_time='. $this->endDate .'&min_time='. $this->startDate .'');
//
//            if($response->status() == 200) {
//                $fomrattedResponse = $response->collect();
//                array_push($this->bucketArray, $fomrattedResponse);
//                if($account->cash){
//                    array_push($this->cashTotal, $fomrattedResponse);
//                }
//            }
//        }
//
//    }

    public function invoiceHelium()
    {
        $invoice_date = Invoice::select('invoice_date')->get();

        $this->invoiceDate = [];
        foreach($invoice_date as $date) {
            $newDate = Carbon::parse($date->invoice_date)->format('F - Y');

            $this->invoiceDate[] = $newDate;
        }

    }

    public function showTotals()
    {

        if($this->returnDate == null) {
            $this->returnDate = Carbon::now()->subMonth(1)->format('F - Y');
        }

        $splitDate = explode(" - ", $this->returnDate);

        $invoiceData = Invoice::whereYear('invoice_date', '=', $splitDate[1])->whereMonth('invoice_date', '=', Carbon::parse($splitDate[0])->format('m'))->get();

        $this->bucketArray = [];
        if($invoiceData){
            foreach($invoiceData as $data){
                $this->bucketArray['data'] = $data['invoice_data'];
                $this->bucketArray['accountId'] = $data['accounts_id'];
            }
        }
    }


    public function currentValue()
    {
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
        if (str_contains($this->profilePicture, '/public/images/')) {
            $path = $this->profilePicture;
        }else {
            $filenameWithExtEdit = $this->profilePicture->getClientOriginalName();
            $filename = pathinfo($filenameWithExtEdit, PATHINFO_FILENAME);
            $extension = $this->profilePicture->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $this->profilePicture->storeAs(public_path('images'),$fileNameToStore ,'real_public' );
        }

        $this->editData->update([
            'account_image' => $path,
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
        $this->invoiceHelium();
        $this->showTotals();
//        $this->overallHeliumUsingCalender();
        return view('livewire.accounts-table');
    }
}
