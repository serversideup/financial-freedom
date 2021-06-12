<?php

namespace App\Http\Controllers\API\CreditCards;

use App\Http\Controllers\Controller;
use App\Models\Accounts\CreditCard;
use App\Services\Transactions\LoadTransactions;
use Auth;

class CreditCardsTransactionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
        $this->middleware('can:show,creditCard')->only('index');
    }

    public function index( \Illuminate\Http\Request $request, CreditCard $creditCard )
    {
        $loadTransactions = new LoadTransactions( Auth::user(), $request->all(), $creditCard );
        $transactions = $loadTransactions->load();

        return response()->json( $transactions );
    }
}