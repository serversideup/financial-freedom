<?php

namespace App\Services\Budgets;

use App\Models\Budgets\Budget;
use App\Models\Budgets\BudgetPeriod;
use App\Models\Transactions\Transaction;
use App\Services\BudgetsPeriods\ApplyTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class StoreBudget
{
    private $data;
    private $budget;
    private $budgetPeriod;

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

        $this->budgetPeriod = new BudgetPeriod();

        $this->budgetPeriod->user_id = Auth::user()->id;
        $this->budgetPeriod->name = $this->budget->name;
        $this->budgetPeriod->category_id = $this->budget->category_id;
        $this->budgetPeriod->start_date = $startOfMonth;
        $this->budgetPeriod->end_date = $endOfMonth;
        $this->budgetPeriod->amount = $this->budget->amount;

        $this->budgetPeriod->save();

        $this->applyTransactions();
    }

    private function applyTransactions()
    {
        $existingTransactions = Transaction::where( 'user_id', '=', Auth::user()->id )
                                           ->whereDate( 'date', '<=', $this->budgetPeriod->end_date )
                                           ->whereDate( 'date', '>=', $this->budgetPeriod->start_date )
                                           ->where( 'category_id', '=', $this->budgetPeriod->category_id )
                                           ->get();

        foreach( $existingTransactions as $transaction ){
            $applyTransaction = new ApplyTransaction( $transaction );
            $applyTransaction->apply();
        }
    }
}