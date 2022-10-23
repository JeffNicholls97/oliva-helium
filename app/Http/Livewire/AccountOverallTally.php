<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AccountOverallTally extends Component
{
    public $accounttally;
    public $accounts;

    public function render()
    {
        $this->emit('refreshComponent');
        return view('livewire.account-overall-tally');
    }
}
