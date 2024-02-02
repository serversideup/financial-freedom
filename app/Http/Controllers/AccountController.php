<?php

namespace App\Http\Controllers;

use App\Http\Requests\Accounts\StoreAccountRequest;
use App\Models\Institution;
use App\Services\Accounts\StoreAccount;
use App\Services\CashAccounts\IndexCashAccounts;
use App\Services\CreditCards\IndexCreditCards;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AccountController extends Controller
{
    public function index( Request $request ): Response
    {
        return Inertia::render('Accounts/Index', [
            'group' => 'accounts',
            'cashAccounts' => fn() => ( new IndexCashAccounts() )->index(),
            'creditCards' => fn() => ( new IndexCreditCards() )->index(),
            'institutions' => fn () => ( Institution::orderBy('name', 'ASC')->get() ),
        ]);
    }

    public function store( StoreAccountRequest $request ): RedirectResponse
    {
        ( new StoreAccount() )->store( $request );
        return redirect()->back();
    }

    // public function destroy( Account $account ): RedirectResponse
    // {
    //     ( new DeleteAccount() )->delete( $account );
    //     return redirect()->back();
    // }
}