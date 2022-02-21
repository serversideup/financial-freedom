<?php

namespace App\Http\Controllers\Web\CheckingAccounts;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\Accounts\CheckingAccount;

class CheckingAccountsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
        $this->middleware('can:show,checkingAccount')->only('show');
    }

    public function show( CheckingAccount $checkingAccount )
    {
        return Inertia::render('CheckingAccounts/Show', [
            'id' => $checkingAccount->id
        ]);
    }
}