<?php

namespace App\Http\Controllers\API\SavingsAccounts;

use App\Http\Controllers\Controller;
use App\Models\Accounts\SavingsAccount;
use App\Services\Transactions\LoadTransactions;
use Auth;

class SavingsAccountsTransactionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
        $this->middleware('can:show,savingsAccount')->only('index');
    }

    public function index( \Illuminate\Http\Request $request, SavingsAccount $savingsAccount )
    {
        $loadTransactions = new LoadTransactions( Auth::user(), $request->all(), $savingsAccount );
        $transactions = $loadTransactions->load();

        return response()->json( $transactions );
    }
}