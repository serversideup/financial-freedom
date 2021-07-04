<?php

namespace App\Http\Controllers\Web\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Transactions\Transaction;
use App\Services\Transactions\AddTransaction;
use App\Services\Transactions\ShowTransaction;
use App\Services\Transactions\UpdateTransaction;
use App\Services\Accounts\LoadAccounts;
use Inertia\Inertia;
use Auth;
use Request;

class TransactionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
        $this->middleware('can:show,transaction')->only('show');
        $this->middleware('can:update,transaction')->only('update');
    }

    public function index()
    {
        return Inertia::render('Transactions/Index');
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

    public function show( Transaction $transaction )
    {
        $showTransaction = new ShowTransaction( Auth::user(), $transaction->id );
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

    public function update( Transaction $transaction )
    {
        $updateTransaction = new UpdateTransaction( $transaction->id, Request::all() );
        $updateTransaction->update();

        return redirect('/transactions/'.$transaction->id);
    }
}