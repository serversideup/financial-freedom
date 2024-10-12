<?php

namespace Modules\Transaction\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CashAccounts\IndexCashAccounts;
use App\Services\CreditCards\IndexCreditCards;
use Modules\Category\Services\IndexGroups;
use App\Services\Loans\IndexLoans;
use Modules\Transaction\Services\ImportTransactions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ImportController extends Controller
{
    public function index( Request $request ): Response
    {
        return Inertia::render('Transactions/Import/Index', [
            'group' => 'transactions',
            'groups' => fn () => ( new IndexGroups() )->index( $request ),
            'cashAccounts' => fn() => ( new IndexCashAccounts() )->index(),
            'creditCards' => fn() => ( new IndexCreditCards() )->index(),
            'loans' => fn() => ( new IndexLoans() )->index(),
        ]);
    }

    public function store( Request $request ): RedirectResponse
    {
        ( new ImportTransactions() )
            ->execute( 
                $request->get('account'),
                $request->get('transactions')
            );

        return redirect('/transactions');
    }
}