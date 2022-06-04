<?php

namespace App\Services\Budgets;

use App\Models\Budgets\Budget;
use App\Models\Budgets\BudgetPeriod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class StoreBudget
{
    private $data;
    private $budget;

    public function __construct( $data )
    {
        $this->data = $data;
    }

    public function create()
    {
        $this->persistBudget();
        $this->addBudgetPeriod();

        return $this->budget;
    }

    private function persistBudget()
    {
        $this->budget = new Budget();

        $this->budget->user_id = Auth::user()->id;
        $this->budget->name = $this->data['name'];
        $this->budget->type = $this->data['type'];
        $this->budget->amount = $this->data['amount'];
        $this->budget->category_id = $this->data['category']['id'];
        $this->budget->frequency = $this->data['frequency'];
        $this->budget->renews = $this->data['renews'];

        $this->budget->save();
    }

    private function addBudgetPeriod()
    {
        $now = Carbon::now();
        $startOfMonth = $now->startOfMonth()->format('Y-m-d');
        $endOfMonth = $now->endOfMonth()->format('Y-m-d');

        $budgetPeriod = new BudgetPeriod();

        $budgetPeriod->user_id = Auth::user()->id;
        $budgetPeriod->name = $this->budget->name;
        $budgetPeriod->category_id = $this->budget->category_id;
        $budgetPeriod->start_date = $startOfMonth;
        $budgetPeriod->end_date = $endOfMonth;
        $budgetPeriod->amount = $this->budget->amount;

        $budgetPeriod->save();
    }
}