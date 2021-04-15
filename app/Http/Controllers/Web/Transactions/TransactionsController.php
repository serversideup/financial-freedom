<?php

namespace App\Http\Controllers\Web\Transactions;

use App\Http\Controllers\Controller;
use App\Services\Accounts\LoadAccounts;
use App\Services\Transactions\AddTransaction;
use App\Services\Transactions\LoadTransactions;
use App\Services\Transactions\ShowTransaction;
use App\Services\Transactions\UpdateTransaction;
use Inertia\Inertia;
use Auth;
use Request;

class TransactionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
    }

    public function index()
    {
        $transactionLoader = new LoadTransactions( Auth::user(), Request::all() );
        $transactions = $transactionLoader->load();
        
        $accountLoader = new LoadAccounts( Auth::user() );
        $accounts = $accountLoader->load();

        return Inertia::render('Transactions/Index', [
            'transactions' => $transactions,
            'accounts' => $accounts
        ]);
    }

    public function import()
    {
        $accountLoader = new LoadAccounts( Auth::user(), ['credit-cards', 'checking'] );
        $accounts = $accountLoader->load();

        return Inertia::render('Transactions/Import/Import', [
            'checkingAccounts' => $accounts['checking_accounts'],
            'creditCards' => $accounts['credit_cards']
        ]);
    }

    public function show( $transaction )
    {
        $showTransaction = new ShowTransaction( Auth::user(), $transaction );
        $transaction = $showTransaction->show();

        return Inertia::render('Transactions/Show/Show', [
            'transaction' => $transaction
        ]);
    }

    public function store()
    {
        $addTransaction = new AddTransaction( Auth::user(), Request::all() );
        $addTransaction->store();

        return redirect('/transactions');
    }

    public function update( $transactionID )
    {
        $updateTransaction = new UpdateTransaction( $transactionID, Request::all() );
        $updateTransaction->update();

        return redirect('/transactions/'.$transactionID);
    }
}