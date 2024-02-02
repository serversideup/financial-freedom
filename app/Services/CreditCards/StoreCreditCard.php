<?php

namespace App\Services\CreditCards;

use App\Data\CreditCardData;
use App\Models\CreditCard;

class StoreCreditCard
{
    public function store( CreditCardData $creditCardData )
    {
        return CreditCard::create([
            'user_id' => $creditCardData->userId,
            'institution_id' => $creditCardData->institutionId,
            'name' => $creditCardData->name,
            'brand' => $creditCardData->brand,
            'description' => $creditCardData->description,
            'interest_rate' => $creditCardData->interestRate,
            'credit_limit' => $creditCardData->creditLimit,
            'balance' => $creditCardData->balance,
        ]);
    }
}