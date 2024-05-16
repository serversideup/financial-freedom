<?php

namespace App\Services\CreditCards;

use App\Models\CreditCard;

class IndexCreditCards
{
    public function index()
    {
        $creditCards = CreditCard::with('institution')
            ->with('rules')
            ->where('user_id', auth()->id())
            ->orderBy('name', 'ASC')
            ->get();

        return $creditCards;
    }
}