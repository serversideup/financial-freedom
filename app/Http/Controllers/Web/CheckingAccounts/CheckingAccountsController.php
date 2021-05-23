<?php

namespace App\Http\Controllers\Web\CheckingAccounts;

use App\Http\Controllers\Controller;
use Inertia\Inertia;


class CheckingAccountsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
    }

    public function show( $checkingAccount )
    {
        return Inertia::render('CheckingAccounts/Show', [
            'id' => $checkingAccount
        ]);
    }
}