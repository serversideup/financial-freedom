<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class LoanData extends Data
{
    public function __construct(
        public int|Optional $id,
        public int|Optional $userId,
        public int|Optional $institutionId,
        public string $name,
        public string $type,
        public string $description,
        public string $dateOpened,
        public float $interestRate,
        public float $remainingBalance,
        public float $originalBalance,
        public float $paymentAmount
    ){}

    public static function fromCreateRequest( $request ): self
    {
        return new self(
            Optional::create(),
            userId: $request->user()->id,
            institutionId: $request->input('institution_id'),
            name: $request->input('name'),
            type: $request->input('type'),
            description: $request->input('description'),
            dateOpened: $request->input('date_opened'),
            interestRate: $request->input('interest_rate') ? $request->input('interest_rate') : 0.00,
            remainingBalance: $request->input('remaining_balance'),
            originalBalance: $request->input('original_balance'),
            paymentAmount: $request->input('payment_amount')
        );
    }
}