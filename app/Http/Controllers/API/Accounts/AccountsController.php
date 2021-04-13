<?php

namespace App\Http\Controllers\API\Accounts;

use App\Http\Controllers\Controller;
use App\Services\Accounts\LoadAccounts;
use Auth;
use Request;

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
}