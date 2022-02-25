<?php

namespace App\Http\Controllers\Web\GiftCards;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\Accounts\GiftCard;

class GiftCardsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
        $this->middleware('can:show,giftCard')->only('show');
    }

    public function show( GiftCard $giftCard )
    {
        return Inertia::render('GiftCards/Show', [
            'id' => $giftCard->id
        ]);
    }
}