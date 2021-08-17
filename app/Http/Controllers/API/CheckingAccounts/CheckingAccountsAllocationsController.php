<?php

namespace App\Http\Controllers\API\CheckingAccounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckingAccounts\AllocateCheckingAccountRequest;
use App\Models\Accounts\CheckingAccount;
use App\Services\Allocations\LoadAllocations;
use App\Services\Allocations\StoreAllocation;

use Request;
use Auth;

class CheckingAccountsAllocationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
        $this->middleware('can:show,checkingAccount')->only('index');
        $this->middleware('can:update,checkingAccount')->only('store');
    }

    public function index( CheckingAccount $checkingAccount )
    {
        $loadAllocations = new LoadAllocations( 'checking-account', $checkingAccount->id );
        $allocations = $loadAllocations->load();

        return response()->json( $allocations ? $allocations : [] );      
    }

    public function store( AllocateCheckingAccountRequest $request, CheckingAccount $checkingAccount )
    {
        $storeAllocation = new StoreAllocation( Auth::user(), $request->all(), $checkingAccount );
        $allocation = $storeAllocation->store();
        
        return response()->json( $allocation, 201 );
    }
}