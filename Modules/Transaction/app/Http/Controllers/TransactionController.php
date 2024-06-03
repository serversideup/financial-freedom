<?php

namespace Modules\Transaction\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CashAccounts\IndexCashAccounts;
use App\Services\CreditCards\IndexCreditCards;
use App\Services\Groups\IndexGroups;
use App\Services\Loans\IndexLoans;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Modules\Transaction\Services\IndexTransactions;

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
}