<?php

namespace App\Http\Controllers\Web\CreditCards;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\Accounts\CreditCard;

class CreditCardsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
        $this->middleware('can:show,creditCard')->only('show');
    }

    public function show( CreditCard $creditCard )
    {
        return Inertia::render('CreditCards/Show', [
            'id' => $creditCard->id
        ]);
    }
}