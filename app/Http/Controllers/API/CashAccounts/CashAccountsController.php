<?php

namespace App\Http\Controllers\API\CashAccounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\CashAccounts\CreateCashAccountRequest;
use App\Http\Requests\CashAccounts\UpdateCashAccountRequest;
use App\Models\Accounts\CashAccount;
use App\Services\Accounts\ShowAccount;
use App\Services\Accounts\UpdateAccount;
use App\Services\CashAccounts\CreateCashAccount;

class CashAccountsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
        $this->middleware('can:show,cashAccount')->only('show');
        $this->middleware('can:update,cashAccount')->only('update');
    }

    public function show( \Illuminate\Http\Request $request, CashAccount $cashAccount )
    {
        $showAccount = new ShowAccount( 
            $request->user(),
            $cashAccount->id,
            'cash'
        );
        
        return response()->json( $showAccount->show() );
    }

    public function update( UpdateCashAccountRequest $request, CashAccount $cashAccount )
    {
        $updateAccount = new UpdateAccount(
            $request->user(),
            $request->all()
        );

        $updateAccount->update( $cashAccount->id, 'cash-account' );

        return response()->json('', 204);
    }

    public function store( CreateCashAccountRequest $request )
    {
        ( new CreateCashAccount(
            $request->user(),
            $request->all()
        ) )->create();

        return response()->json( null, 201 );
    }
}