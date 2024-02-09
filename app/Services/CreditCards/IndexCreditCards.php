<?php

namespace App\Services\CreditCards;

use App\Models\CreditCard;

class IndexCreditCards
{
    public function index()
    {
        $creditCards = CreditCard::with('institution')
            ->where('user_id', auth()->id())
            ->orderBy('name', 'ASC')
            ->get();

        return $creditCards;
    }
}