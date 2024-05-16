<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class CreditCardData extends Data
{
    public function __construct(
        public int|Optional $id,
        public int|Optional $userId,
        public int|Optional $institutionId,
        public string $brand,
        public string $name,
        public string $description,
        public float $interestRate,
        public float $creditLimit,
        public float $balance
    ){}

    public static function fromCreateRequest( $request ): self
    {
        return new self(
            Optional::create(),
            userId: $request->user()->id,
            institutionId: $request->input('institution_id'),
            brand: $request->input('brand'),
            name: $request->input('name'),
            description: $request->input('description'),
            interestRate: $request->input('interest_rate') ? $request->input('interest_rate') : 0.00,
            creditLimit: $request->input('credit_limit'),
            balance: $request->input('balance'),
        );
    }
}