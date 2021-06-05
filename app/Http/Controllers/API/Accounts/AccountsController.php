<?php

namespace App\Http\Controllers\API\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Accounts\StoreAccountRequest;
use App\Services\Accounts\LoadAccounts;
use App\Services\Accounts\StoreAccount;
use Auth;

class AccountsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $accountsLoader = new LoadAccounts( Auth::user() );
        $accounts = $accountsLoader->load();

        return response()->json( $accounts );
    }

    public function store( StoreAccountRequest $request )
    {
        $storeAccount = new StoreAccount( $request->user(), $request->all() );
        $storeAccount->store();

        return response()->json( null, 201 );
    }
}