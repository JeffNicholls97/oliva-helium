<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class TopBar extends Component
{
    public $payoutDate;

    public function getPayoutDate()
    {
        //will need to get this info from the settings model - CHANGE
        $payoutDateNew = Carbon::now()->addDay();

        $this->payoutDate = $payoutDateNew->diffForHumans();

    }

    public function render()
    {
        $this->getPayoutDate();
        return view('livewire.top-bar');
    }
}
