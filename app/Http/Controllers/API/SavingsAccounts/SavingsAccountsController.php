<?php

namespace App\Http\Controllers\API\SavingsAccounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\SavingsAccounts\CreateSavingsAccountRequest;
use App\Http\Requests\SavingsAccounts\UpdateSavingsAccountRequest;
use App\Models\Accounts\SavingsAccount;
use App\Services\Accounts\ShowAccount;
use App\Services\Accounts\UpdateAccount;
use App\Services\SavingsAccounts\CreateSavingsAccount;

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
            $savingsAccount->id, 
            'savings' 
        );

        return response()->json( $showAccount->show() );
    }

    public function store( CreateSavingsAccountRequest $request )
    {
        ( new CreateSavingsAccount( 
            $request->user(),
            $request->all()
        ) )->create();

        return response()->json( null, 201 );
    }

    public function update( UpdateSavingsAccountRequest $request, SavingsAccount $savingsAccount )
    {
        $updateAccount = new UpdateAccount(
            $request->user(),
            $request->all()
        );

        $updateAccount->update( $savingsAccount->id, 'savings-account' );

        return response()->json('', 204);
    }
}