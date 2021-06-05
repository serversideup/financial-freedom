<?php

namespace App\Http\Controllers\Web\SavingsAccounts;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\Accounts\SavingsAccount;

class SavingsAccountsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
        $this->middleware('can:show,savingsAccount')->only('show');
    }

    public function show( SavingsAccount $savingsAccount )
    {
        return Inertia::render('SavingsAccounts/Show', [
            'id' => $savingsAccount->id
        ]);
    }
}