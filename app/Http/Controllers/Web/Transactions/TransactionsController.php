<?php

namespace App\Http\Controllers\Web\Transactions;

use App\Http\Controllers\Controller;
use App\Models\Accounts\CheckingAccount;
use App\Models\Accounts\CreditCard;
use App\Models\Transactions\Transaction;
use App\Services\Transactions\AddTransaction;
use App\Services\Transactions\LoadTransactions;
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
        
        $checkingAccounts = CheckingAccount::where( 'user_id', '=', Auth::user()->id )
                                           ->with('institution')
                                           ->get();

        $creditCards = CreditCard::where( 'user_id', '=', Auth::user()->id )
                                 ->with('institution')
                                 ->get();

        return Inertia::render('Transactions/Index', [
            'initialTransactions' => $transactions,
            'checkingAccounts' => $checkingAccounts,
            'creditCards' => $creditCards
        ]);
    }

    public function import()
    {
        $checkingAccounts = CheckingAccount::where( 'user_id', '=', Auth::user()->id )
                                           ->with('institution')
                                           ->get();

        $creditCards = CreditCard::where( 'user_id', '=', Auth::user()->id )
            ->with('institution')
            ->get();
            
        
        return Inertia::render('Transactions/Import/Import', [
            'checkingAccounts' => $checkingAccounts,
            'creditCards' => $creditCards
        ]);
    }

    public function show( $transaction )
    {
        $transaction = Transaction::where('id', '=', $transaction)
                                  ->with(['accountable' => function( $query ){
                                      $query->with('institution');
                                  }])
                                  ->with(['splits' => function( $query ){
                                    $query->with('tags');
                                  }])
                                  ->with('tags')
                                  ->first();

        return Inertia::render('Transactions/Show/Show', [
            'transaction' => $transaction
        ]);
    }

    public function view()
    {
        
    }

    public function store()
    {
        $addTransaction = new AddTransaction( Auth::user(), Request::all() );
        $transaction = $addTransaction->store();

        return redirect('/transactions');
    }

    public function update( $transactionID )
    {
        $updateTransaction = new UpdateTransaction( $transactionID, Request::all() );
        $updateTransaction->update();

        return redirect('/transactions/'.$transactionID);
    }
}