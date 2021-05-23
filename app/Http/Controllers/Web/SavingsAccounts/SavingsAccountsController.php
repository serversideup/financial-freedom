<?php

namespace App\Http\Controllers\Web\SavingsAccounts;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\Accounts\SavingsAccount;

class SavingsAccountsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
        $this->middleware('can:show,savingsAccount')->only('show');
    }

    public function show( SavingsAccount $savingsAccount )
    {
        $savingsAccount = SavingsAccount::where('id', '=', $savingsAccount)
                                          ->with('institution')
                                          ->with('transactions')
                                          ->first();

        return Inertia::render('SavingsAccounts/Show', [
            'savingsAccount' => $savingsAccount
        ]);
    }
}