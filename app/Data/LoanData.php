<?php

namespace App\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class LoanData extends Data
{
    public function __construct(

    ){}

    public static function fromRequest( $request ): self
    {
        return new self(
            
        );
    }
}