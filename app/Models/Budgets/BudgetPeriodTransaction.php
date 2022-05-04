<?php

namespace App\Models\Budgets;

use Illuminate\Database\Eloquent\Model;

class BudgetPeriodTransaction extends Model
{
    public $incrementing = true;

    protected $table = 'budgets_periods_transactions';
}