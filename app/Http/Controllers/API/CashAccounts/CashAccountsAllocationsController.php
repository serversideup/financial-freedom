<?php

namespace App\Http\Controllers\API\CashAccounts;

use App\Http\Controllers\Controller;
use App\Models\Accounts\CashAccount;
use App\Services\Allocations\LoadAllocations;
use App\Services\Allocations\StoreAllocation;

use Request;
use Auth;

class CashAccountsAllocationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
        $this->middleware('can:show,cashAccount')->only('index');
        $this->middleware('can:update,cashAccount')->only('store');
    }

    public function index( CashAccount $cashAccount )
    {
        $loadAllocations = new LoadAllocations( 'cash-account', $cashAccount->id );
        $allocations = $loadAllocations->load();

        return response()->json( $allocations ? $allocations : [] );      
    }

    public function store( \Illuminate\Http\Request $request, CashAccount $cashAccount )
    {
        $storeAllocation = new StoreAllocation( Auth::user(), $request->all(), $cashAccount );
        $allocation = $storeAllocation->store();
        
        return response()->json( $allocation, 201 );
    }
}