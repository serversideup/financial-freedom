<?php

namespace App\Http\Controllers\API\Loans;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Loan;
use App\Services\Transactions\LoadTransactions;
use Auth;

class LoansTransactionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
        $this->middleware('can:show,loan')->only('index');
    }

    public function index( \Illuminate\Http\Request $request, Loan $loan )
    {
        $loadTransactions = new LoadTransactions( Auth::user(), $request->all(), $loan );
        $transactions = $loadTransactions->load();

        return response()->json( $transactions );
    }
}