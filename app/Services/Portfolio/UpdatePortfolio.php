<?php

namespace App\Services\Portfolio;

use App\Models\User;

class UpdatePortfolio
{
    public function update( $request )
    {
        $request->user()->update( $request->validated() );
    }
}