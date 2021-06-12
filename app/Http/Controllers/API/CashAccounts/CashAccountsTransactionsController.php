<?php

namespace App\Http\Controllers\API\CashAccounts;

use App\Http\Controllers\Controller;
use App\Models\Accounts\CashAccount;
use App\Services\Transactions\LoadTransactions;
use Auth;

class CashAccountsTransactionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
        $this->middleware('can:show,cashAccount')->only('index');
    }

    public function index( \Illuminate\Http\Request $request, CashAccount $cashAccount )
    {
        $loadTransactions = new LoadTransactions( Auth::user(), $request->all(), $cashAccount );
        $transactions = $loadTransactions->load();

        return response()->json( $transactions );
    }
}