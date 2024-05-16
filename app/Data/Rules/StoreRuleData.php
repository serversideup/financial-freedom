<?php

namespace App\Data\Rules;

use Spatie\LaravelData\Data;

class StoreRuleData extends Data
{
    public function __construct(
        public array $account,
        public string $searchString,
        public string $replaceString,
        public array $category,
    ){}
}