<?php

namespace App\Http\Controllers\API\GiftCards;

use App\Http\Controllers\Controller;
use App\Http\Requests\GiftCards\CreateGiftCardRequest;
use App\Services\Accounts\ShowAccount;
use App\Models\Accounts\GiftCard;
use App\Services\GiftCards\CreateGiftCard;
use Illuminate\Http\Request;

class GiftCardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
        $this->middleware('can:show,giftCard')->only('show');
        $this->middleware('can:update,giftCard')->only('update');
    }

    public function show( Request $request, GiftCard $giftCard )
    {
        $showAccount = new ShowAccount( 
            $request->user(), 
            $giftCard->id, 
            'gift-card' 
        );

        return response()->json( $showAccount->show() );
    }

    public function store( CreateGiftCardRequest $request )
    {
        ( new CreateGiftCard(
            $request->user(),
            $request->all()
        ) )->create();

        return response()->json( null, 201 );
    }

    public function update()
    {

    }
}