<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Accounts;

class AccountsTable extends Component
{
    public $accounts;

    public function renderTable()
    {
        $this->accounts = Accounts::all();
    }

    public function deleteAccountData($id)
    {
        Accounts::find($id)->delete();
        session()->flash('message', 'Data deleted successfully.');
    }

    public function render()
    {
        $this->renderTable();
        return view('livewire.accounts-table');
    }
}
