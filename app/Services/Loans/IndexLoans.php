<?php

namespace App\Services\Loans;

use App\Models\Loan;

class IndexLoans
{
    public function index()
    {
        $loans = Loan::with('institution')
            ->with('rules')
            ->where('user_id', auth()->id())
            ->orderBy('name', 'ASC')
            ->get();

        return $loans;
    }
}