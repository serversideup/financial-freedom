<?php

namespace App\Services\BudgetsPeriods;

use App\Models\Budgets\BudgetPeriod;
use App\Models\Budgets\BudgetPeriodTransaction;
use Illuminate\Support\Carbon;

class ApplyTransaction
{
    private $transaction;
    private $budgetPeriod;

    public function __construct( $transaction )
    {
        $this->transaction = $transaction;
    }

    public function apply()
    {
        $this->findBudgetPeriod();
        $this->applyTransactionToBudgetPeriod();
    }

    private function findBudgetPeriod()
    {
        $now = Carbon::now();

        $this->budgetPeriod = BudgetPeriod::where('user_id', '=', $this->transaction->user_id)
                                    ->whereDate( 'start_date', '<=', $now->format('Y-m-d') )
                                    ->whereDate( 'end_date', '>=', $now->format('Y-m-d') )
                                    ->where('category_id', '=', $this->transaction->category_id)
                                    ->first();
    }

    private function applyTransactionToBudgetPeriod()
    {
        if( $this->budgetPeriod ){
            $budgetPeriodTransaction = new BudgetPeriodTransaction();

            $budgetPeriodTransaction->user_id = $this->transaction->user_id;
            $budgetPeriodTransaction->budget_period_id = $this->budgetPeriod->id;
            $budgetPeriodTransaction->transaction_id = $this->transaction->id;

            $budgetPeriodTransaction->save();
        }
    }
}