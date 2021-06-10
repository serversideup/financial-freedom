<?php

namespace App\Http\Controllers\Web\Cash;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\Accounts\CashAccount;

class CashAccountsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
        $this->middleware('can:show,cashAccount')->only('show');
    }

    public function show( CashAccount $cashAccount )
    {
        return Inertia::render('CashAccounts/Show', [
            'id' => $cashAccount->id
        ]);
    }
}