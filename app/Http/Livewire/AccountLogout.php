<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class AccountLogout extends Component
{
    public function render()
    {
        return view('livewire.account-logout');
    }
}
