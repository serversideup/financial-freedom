<?php

namespace App\Services\CashAccounts;

use App\Data\CashAccountData;
use App\Models\CashAccount;

class StoreCashAccount
{
    public function store( CashAccountData $cashAccountData )
    {
        return CashAccount::create([
            'user_id' => $cashAccountData->userId,
            'institution_id' => $cashAccountData->institutionId,
            'type' => $cashAccountData->type,
            'name' => $cashAccountData->name,
            'description' => $cashAccountData->description,
            'balance' => $cashAccountData->balance,
            'interest_rate' => $cashAccountData->interestRate,
        ]);
    }
}