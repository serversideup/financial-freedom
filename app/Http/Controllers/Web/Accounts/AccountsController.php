<?php

namespace App\Http\Controllers\Web\Accounts;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class AccountsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
    }

    public function index()
    {
        return Inertia::render('Accounts/Index');
    }
}