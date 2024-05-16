<?php

namespace App\Services\Loans;

use App\Data\LoanData;
use App\Models\Loan;

class StoreLoanAccount
{
    public function store( LoanData $loanData )
    {
        return Loan::create([
            'user_id' => $loanData->userId,
            'institution_id' => $loanData->institutionId,
            'name' => $loanData->name,
            'type' => $loanData->type,
            'description' => $loanData->description,
            'opened_at' => $loanData->dateOpened,
            'interest_rate' => $loanData->interestRate,
            'remaining_balance' => $loanData->remainingBalance,
            'original_balance' => $loanData->originalBalance,
            'payment_amount' => $loanData->paymentAmount
        ]);
    }
}