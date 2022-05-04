<?php

namespace App\Services\Budgets;

use App\Models\Budgets\Budget;
use Illuminate\Support\Facades\Auth;

class LoadBudgets
{
    public function __construct()
    {

    }

    public function load()
    {
        $budgets = Budget::where( 'user_id', '=', Auth::user()->id )
                         ->with('category')
                         ->get();
                         
        return $budgets;
    }
}