<?php

namespace App\Http\Controllers\Web\Accounts;

use Auth;
use Redirect;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

use App\Models\Institutions\Institution;

use App\Http\Requests\Accounts\StoreAccountRequest;
use App\Services\Accounts\StoreAccount;
use App\Services\Accounts\LoadAccounts;

class AccountsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
    }

    public function index()
    {
        $loadAccounts = new LoadAccounts( Auth::user() );
        $accounts = $loadAccounts->load();

        return Inertia::render('Accounts/Index', [
            'accounts' => $accounts
        ]);
    }

    public function create()
    {
        $institutions = Institution::orderBy('name', 'ASC')->get();

        return Inertia::render('Accounts/Create', [
            'institutions' => $institutions,
            'csrf' => csrf_token()
        ]);
    }

    public function store( StoreAccountRequest $request )
    {
        $storeAccount = new StoreAccount( $request->user(), $request->all() );
        $storeAccount->store();

        return Redirect::to('/accounts');
    }
}