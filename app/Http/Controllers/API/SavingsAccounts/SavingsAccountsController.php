<?php

namespace App\Http\Controllers\API\SavingsAccounts;

use App\Http\Controllers\Controller;
use App\Services\Accounts\ShowAccount;
use App\Services\Accounts\UpdateAccount;

class SavingsAccountsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
        $this->middleware('can:show,savingsAccount')->only('show');
        $this->middleware('can:update,savingsAccount')->only('update');
    }

    public function show( \Illuminate\Http\Request $request, SavingsAccount $savingsAccount )
    {
        $showAccount = new ShowAccount( 
            $request->user(), 
            $savingsAccount, 
            'savings' 
        );

        return response()->json( $showAccount->show() );
    }

    public function update( \Illuminate\Http\Request $request, SavingsAcount $savingsAccount )
    {
        $updateAccount = new UpdateAccount(
            $request->user(),
            $request->all()
        );

        $updateAccount->update( $savingsAccount->id, 'savings-account' );

        return response()->json('', 204);
    }
}