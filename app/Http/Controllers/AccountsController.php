<?php

namespace App\Http\Controllers;

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
        return view('pages.accounts-overview', compact('accountId'));
    }
}
