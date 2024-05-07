<?php

namespace App\Http\Controllers;

use App\Services\CashAccounts\IndexCashAccounts;
use App\Services\CreditCards\IndexCreditCards;
use App\Services\Groups\IndexGroups;
use App\Services\Loans\IndexLoans;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TransactionsImportController extends Controller
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

    public function store(): RedirectResponse
    {
        return redirect()->back();
    }
}