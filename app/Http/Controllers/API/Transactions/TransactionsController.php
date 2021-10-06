<?php

namespace App\Http\Controllers\API\Transactions;

use App\Http\Controllers\Controller;
use App\Services\Transactions\LoadTransactions;
use App\Services\Transactions\ImportTransactions;
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

    public function import()
    {
        $importTransactions = new ImportTransactions( Auth::user(), Request::get('account'), Request::get('transactions') );
        $importTransactions->import();
    }
}