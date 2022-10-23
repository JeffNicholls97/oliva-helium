<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function index()
    {
        return view('pages.accounts');
    }
    public function show($id)
    {
        $accountId = $id;
        $getMinerName = Accounts::where('id', $id)->first()->miner_name;
        $minerName = str_replace("-", " ", $getMinerName);
        return view('pages.accounts-overview', compact('accountId', 'minerName'));
    }
}
