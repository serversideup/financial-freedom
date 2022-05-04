<?php

namespace App\Http\Controllers\API\Budgets;

use App\Http\Controllers\Controller;
use App\Models\Budgets\Budget;
use App\Services\Budgets\LoadBudgets;
use App\Services\Budgets\StoreBudget;
use Illuminate\Http\Request;

class BudgetsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $budgets = ( new LoadBudgets() )->load();
        return response()->json( $budgets );
    }

    public function show()
    {

    }

    public function store( Request $request )
    {
        $budget = ( new StoreBudget( $request->all() ) )->create();
        return response()->json( $budget, 201 );
    }

    public function update()
    {

    }

    public function delete()
    {
        
    }
}