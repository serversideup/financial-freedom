<?php

namespace App\Http\Controllers\Web\Transactions;

use App\Http\Controllers\Controller;
use App\Services\Transactions\SplitTransaction;
use Request;

class TransactionsSplitsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
    }

    public function store( $transactionID )
    {
        $splitTransaction = new SplitTransaction( Request::all(), $transactionID );
        $splitTransaction->split();

        //return redirect( '/transactions/'.$transaction );
    }
}