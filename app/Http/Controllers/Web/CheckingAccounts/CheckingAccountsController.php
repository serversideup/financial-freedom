<?php

namespace App\Http\Controllers\Web\CheckingAccounts;

use Auth;
use Redirect;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\Accounts\CheckingAccount;

class CheckingAccountsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
    }

    public function show( $checkingAccount )
    {
        $checkingAccount = CheckingAccount::where('id', '=', $checkingAccount)
                                          ->with('institution')
                                          ->with('transactions')
                                          ->first();

        return Inertia::render('CheckingAccounts/Show', [
            'checkingAccount' => $checkingAccount
        ]);
    }
}