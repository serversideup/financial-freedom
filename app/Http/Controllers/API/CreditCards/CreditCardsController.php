<?php

namespace App\Http\Controllers\API\CreditCards;

use App\Http\Controllers\Controller;
use App\Services\Accounts\ShowAccount;
use App\Models\Accounts\CreditCard;
use App\Services\Accounts\UpdateAccount;

class CreditCardsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
        $this->middleware('can:show,creditCard')->only('show');
        $this->middleware('can:update,creditCard')->only('update');
    }

    public function show( \Illuminate\Http\Request $request, CreditCard $creditCard )
    {
        $showAccount = new ShowAccount( 
            $request->user(), 
            $creditCard->id, 
            'credit-card' 
        );

        return response()->json( $showAccount->show() );
    }

    public function update( \Illuminate\Http\Request $request, CreditCard $creditCard )
    {
        $updateAccount = new UpdateAccount(
            $request->user(),
            $request->all()
        );

        $updateAccount->update( $creditCard->id, 'credit-card' );

        return response()->json('', 204);

    }
}