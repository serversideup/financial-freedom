<?php

namespace App\Http\Controllers\API\CreditCards;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreditCards\StoreCreditCardRequest;
use App\Services\Accounts\ShowAccount;
use App\Models\Accounts\CreditCard;
use App\Services\Accounts\UpdateAccount;
use App\Http\Requests\CreditCards\UpdateCreditCardRequest;
use App\Services\CreditCards\CreateCreditCard;

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

    public function store( StoreCreditCardRequest $request )
    {
        ( new CreateCreditCard( 
            $request->user(),
            $request->all()
        ) )->create();

        return response()->json( null, 201 );
    }

    public function update( UpdateCreditCardRequest $request, CreditCard $creditCard )
    {
        $updateAccount = new UpdateAccount(
            $request->user(),
            $request->all()
        );

        $updateAccount->update( $creditCard->id, 'credit-card' );

        return response()->json('', 204);

    }
}