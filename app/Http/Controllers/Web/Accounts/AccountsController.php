<?php

namespace App\Http\Controllers\Web\Accounts;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

use App\Services\Institutions\LoadInstitutions;

class AccountsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
    }

    public function index()
    {
        $loadInstitutions = new LoadInstitutions();
        $institutions = $loadInstitutions->load();

        return Inertia::render('Accounts/Index', [
            'institutions' => $institutions
        ]);
    }
}