<?php

namespace App\Http\Controllers\API\CheckingAccounts;

use App\Http\Controllers\Controller;
use App\Services\Accounts\ShowAccount;
use App\Services\Accounts\UpdateAccount;

class CheckingAccountsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
        $this->middleware('can:show,checkingAccount')->only('show');
        $this->middleware('can:update,checkingAccount')->only('update');
    }

    public function show( \Illuminate\Http\Request $request, CheckingAccount $checkingAccount )
    {
        $showAccount = new ShowAccount( 
            $request->user(),
            $checkingAccount,
            'checking'
        );
        
        return response()->json( $showAccount->show() );
    }

    public function update( \Illuminate\Http\Request $request, CheckingAccount $checkingAccount )
    {
        $updateAccount = new UpdateAccount(
            $request->user(),
            $request->all()
        );

        $updateAccount->update( $updateAccount->id, 'checking-account' );

        return response()->json('', 204);
    }
}