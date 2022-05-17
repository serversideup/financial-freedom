<?php

namespace App\Models\Budgets;

use Illuminate\Database\Eloquent\Model;

class BudgetPeriod extends Model
{
    public $incrementing = true;

    protected $table = 'budgets_periods';

    public function transactions()
    {
        return $this->belongsToMany('App\Models\Transactions\Transaction', 'budgets_periods_transactions', 'budget_period_id', 'transaction_id' )
             ->withTimestamps();
    }

    public function category()
    {
        return $this->hasOne('App\Models\Categories\Category', 'id', 'category_id');
    }
}