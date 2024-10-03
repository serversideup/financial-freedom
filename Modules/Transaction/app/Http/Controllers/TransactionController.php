<?php

namespace Modules\Transaction\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CashAccounts\IndexCashAccounts;
use App\Services\CreditCards\IndexCreditCards;
use App\Services\Loans\IndexLoans;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Modules\Category\Services\IndexGroups;
use Modules\Transaction\Http\Requests\StoreTransactionRequest;
use Modules\Transaction\Http\Requests\UpdateTransactionRequest;
use Modules\Transaction\Models\Transaction;
use Modules\Transaction\Services\IndexTransactions;
use Modules\Transaction\Services\StoreTransaction;
use Modules\Transaction\Services\UpdateTransaction;

class TransactionController extends Controller
{
    public function index( Request $request ): Response
    {
        return Inertia::render( 'Transactions/Index', [
            'group' => 'transactions',
            'transactions' => fn () => ( new IndexTransactions() )->execute( $request ),
            'groups' => fn () => ( new IndexGroups() )->index( $request ),
            'cashAccounts' => fn() => ( new IndexCashAccounts() )->index(),
            'creditCards' => fn() => ( new IndexCreditCards() )->index(),
            'loans' => fn() => ( new IndexLoans() )->index(),
            'filters' => $request->all()
        ] );
    }

    public function store( StoreTransactionRequest $request ): RedirectResponse
    {
        ( new StoreTransaction() )->execute( $request );

        return redirect()->route( 'transactions.index' );
    }

    public function show( Transaction $transaction )
    {
        $transaction->load('accountable');

        return Inertia::modal('Transactions/Show', [
            'transaction' => $transaction
        ])
        ->baseRoute('transactions.index');
    }

    public function update( UpdateTransactionRequest $request, Transaction $transaction ): RedirectResponse
    {
        ( new UpdateTransaction() )->execute( $request, $transaction );        

        return redirect()->route( 'transactions.index' );
    }
}