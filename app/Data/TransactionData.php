<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class TransactionData extends Data
{
    public function __construct(
        public int|Optional $id,
        public string|Optional $uuid,
        public int $userId,
        public int $accountableId,
        public string $accountableType,
        public int|Optional $categoryId,
        public float $amount,
        public string $date,
        public string $merchant,
        public string|Optional $description,
        public string $type,
        public int $reconciled,
        public string|Optional $receiptUrl,
        public array|Optional $original
    ){}

    public static function fromCreateRequest( $request, $account ): self
    {
        return new self(
            Optional::create(),
            Optional::create(),
            userId: $request->user()->id,
            accountableId: $account->id,
            accountableType: get_class( $account ),
            categoryId: $request->input('category_id'),
            amount: $request->input('amount'),
            date: $request->input('date'),
            merchant: $request->input('merchant'),
            description: $request->input('description'),
            type: $request->input('type'),
            reconciled: $request->input('reconciled'),
            receiptUrl: $request->input('receipt_url'),
            original: $request->input('original')
        );
    }
}