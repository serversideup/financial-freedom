<?php

namespace App\Services\BudgetsPeriods;

use App\Models\Budgets\Budget;
use App\Models\Budgets\BudgetPeriod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class CreateBudgetsPeriods
{
    public function __construct()
    {

    }

    public function create()
    {
        $budgets = Budget::where('user_id', '=', Auth::user()->id)->get();
        
        $now = Carbon::now();
        $startOfMonth = $now->startOfMonth()->format('Y-m-d');
        $endOfMonth = $now->endOfMonth()->format('Y-m-d');

        foreach( $budgets as $budget ){
            $budgetPeriod = new BudgetPeriod();

            $budgetPeriod->user_id = Auth::user()->id;
            $budgetPeriod->name = $budget->name;
            $budgetPeriod->category_id = $budget->category_id;
            $budgetPeriod->start_date = $startOfMonth;
            $budgetPeriod->end_date = $endOfMonth;
            $budgetPeriod->amount = $budget->amount;

            $budgetPeriod->save();
        }
    }
}