<?php

namespace App\Http\Controllers\API\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transactions\Split;
use App\Models\Transactions\Transaction;
use App\Services\Transactions\UpdateTransaction;
use App\Services\Transactions\AddTransaction;
use App\Services\Transactions\DeleteTransactionSplit;
use App\Services\Transactions\LoadTransactions;
use App\Services\Transactions\ImportTransactions;
use App\Services\Transactions\ShowTransaction;
use App\Services\Transactions\SplitTransaction;

use Auth;
use Request;

class TransactionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $transactions = ( new LoadTransactions( Auth::user(), Request::all() ) )->load();
        return response()->json( $transactions );
    }

    public function show( Transaction $transaction )
    {
        $transaction = ( new ShowTransaction( Auth::user(), $transaction->id ) )->show();
        return response()->json( $transaction );
    }

    public function import()
    {
        $importTransactions = new ImportTransactions( Auth::user(), Request::get('account'), Request::get('transactions') );
        $importTransactions->import();
    }

    public function store()
    {
        $transaction = ( new AddTransaction( Auth::user(), Request::all() ) )->store();
        return response()->json( $transaction );
    }

    public function update( Transaction $transaction )
    {
        $updateTransaction = new UpdateTransaction( $transaction->id, Request::all() );
        $updateTransaction->update();

        return response()->json(null, 204);
    }

    public function split( Transaction $transaction )
    {
        $splitTransaction = new SplitTransaction( Request::all(), $transaction->id );
        $splitTransaction->split();

        return response()->json(null, 204);
    }

    public function deleteSplit( Transaction $transaction, Split $split )
    {
        ( new DeleteTransactionSplit( $split ) )->delete();
        
        return response()->json( null, 201 );
    }
}