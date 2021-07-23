<?php

namespace App\Http\Controllers\API\Allocations;

use App\Http\Controllers\Controller;
use App\Models\Allocations\Allocation;
use App\Services\Allocations\LoadAllocations;
use App\Services\Allocations\StoreAllocation;
use App\Services\Allocations\UpdateAllocations;
use App\Services\Allocations\DeleteAllocation;
use Auth;

class AllocationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
    }

    public function index( \Illuminate\Http\Request $request )
    {
        $loadAllocations = new LoadAllocations( $request->get('account_type'), $request->get('account_id') );
        $allocations = $loadAllocations->load();

        return response()->json( $allocations ? $allocations : [] );      
    }

    public function store( \Illuminate\Http\Request $request )
    {
        $storeAllocation = new StoreAllocation( Auth::user(), $request->all() );
        $allocation = $storeAllocation->store();
        
        return response()->json( $allocation, 201 );
    }

    public function delete( Allocation $allocation )
    {
        $deleteAllocation = new DeleteAllocation( Auth::user(), $allocation );
        $deleteAllocation->delete();

        return response()->json( null, 204 );
    }

    public function update( \Illuminate\Http\Request $request )
    {
        $updateAllocations = new UpdateAllocations( Auth::user(), $request->all() );
        $updateAllocations->update();

        return response()->json( null, 204 );
    }
}