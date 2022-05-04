<?php

namespace App\Models\Budgets;

use Illuminate\Database\Eloquent\Model;

class BudgetPeriod extends Model
{
    public $incrementing = true;

    protected $table = 'budgets_periods';
}