<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class CashAccountData extends Data
{
    public function __construct(
        public int|Optional $id,
        public int|Optional $userId,
        public int|Optional $institutionId,
        public string $type,
        public string $name,
        public string $description,
        public float $balance,
        public float $interestRate,
    ){}

    public static function fromCreateRequest( $request ): self
    {
        return new self(
            Optional::create(),
            userId: $request->user()->id,
            institutionId: $request->input('institution_id'),
            type: $request->input('type'),
            name: $request->input('name'),
            description: $request->input('description'),
            balance: $request->input('balance'),
            interestRate: $request->input('interest_rate') ? $request->input('interest_rate') : 0.00,
        );
    }
}