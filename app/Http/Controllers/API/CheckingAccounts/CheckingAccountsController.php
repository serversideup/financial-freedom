<?php

namespace App\Http\Controllers\API\CheckingAccounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckingAccounts\UpdateCheckingAccountRequest;
use App\Models\Accounts\CheckingAccount;
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
            $checkingAccount->id,
            'checking'
        );
        
        return response()->json( $showAccount->show() );
    }

    public function update( UpdateCheckingAccountRequest $request, CheckingAccount $checkingAccount )
    {
        $updateAccount = new UpdateAccount(
            $request->user(),
            $request->all()
        );

        $updateAccount->update( $checkingAccount->id, 'checking-account' );

        return response()->json('', 204);
    }
}