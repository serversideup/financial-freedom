<?php

namespace App\Http\Controllers\API\CheckingAccounts;

use Request;
use Auth;

use App\Http\Controllers\Controller;
use App\Models\Accounts\CheckingAccount;
use App\Services\Allocations\StoreAllocation;

class CheckingAccountsAllocationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
    }

    public function index( CheckingAccount $checkingAccount )
    {
        $account = CheckingAccount::where('id', '=', $checkingAccount->id)
                                  ->with('allocations')
                                  ->first();

        $allocations = $account->allocations;

        return response()->json( $allocations ? $allocations : [] );
    }

    public function store( CheckingAccount $checkingAccount )
    {
        $storeAllocation = new StoreAllocation( Auth::user(), Request::all(), $checkingAccount );
        $allocation = $storeAllocation->store();
        
        return response()->json( $allocation, 201 );
    }
}