<?php

namespace App\Http\Controllers\Web\Loans;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\Accounts\Loan;

class LoansController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
        $this->middleware('can:show,loan')->only('show');
    }

    public function show( Loan $loan )
    {
        return Inertia::render('Loans/Show', [
            'id' => $loan->id
        ]);
    }
}