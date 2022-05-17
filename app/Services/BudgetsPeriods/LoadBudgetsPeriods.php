<?php

namespace App\Services\BudgetsPeriods;

use App\Models\Budgets\BudgetPeriod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class LoadBudgetsPeriods
{
    public function __construct()
    {

    }

    public function load()
    {
        $now = Carbon::now();

        $budgetsPeriods = BudgetPeriod::where( 'user_id', '=', Auth::user()->id )
                                    ->whereDate( 'start_date', '<=', $now->format('Y-m-d') )
                                    ->whereDate( 'end_date', '>=', $now->format('Y-m-d') )
                                    ->with( 'transactions' )
                                    ->with( 'category' )
                                    ->get();
                         
        return $budgetsPeriods;
    }
}