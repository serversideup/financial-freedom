<?php

namespace App\Http\Controllers\Web\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transactions\Transaction;

use Auth;

class TransactionsReceiptController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
    }

    public function show( $transactionID )
    {
        $transaction = Transaction::where( 'id', '=', $transactionID )->first();

        if( Auth::user()->id == $transaction->user_id ){
            return response()->file( storage_path('app/').$transaction->receipt_url ); 
        }else{
            return abort(403, 'Forbidden');
        }
    }
}
