<?php

namespace App\Http\Controllers\API\CheckingAccounts;

use App\Http\Controllers\Controller;
use App\Models\Accounts\CheckingAccount;
use App\Services\Transactions\LoadTransactions;
use Auth;

class CheckingAccountsTransactionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
        $this->middleware('can:show,checkingAccount')->only('index');
    }

    public function index( \Illuminate\Http\Request $request, CheckingAccount $checkingAccount )
    {
        $loadTransactions = new LoadTransactions( Auth::user(), $request->all(), $checkingAccount );
        $transactions = $loadTransactions->load();

        return response()->json( $transactions );
    }
}