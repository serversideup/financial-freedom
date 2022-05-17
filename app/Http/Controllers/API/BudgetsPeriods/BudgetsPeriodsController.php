<?php

namespace App\Http\Controllers\API\BudgetsPeriods;

use App\Http\Controllers\Controller;
use App\Models\Budgets\BudgetPeriod;
use App\Services\BudgetsPeriods\LoadBudgetsPeriods;
use App\Services\BudgetsPeriods\CreateBudgetsPeriods;
use Illuminate\Http\Request;

class BudgetsPeriodsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $budgetsPeriods = ( new LoadBudgetsPeriods() )->load();
        return response()->json( $budgetsPeriods );
    }

    public function show()
    {

    }

    public function store( Request $request )
    {
        ( new CreateBudgetsPeriods( $request->all() ) )->create();
        return response()->json( null, 201 );
    }
}