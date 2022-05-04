<?php

namespace App\Services\Budgets;

use App\Models\Budgets\Budget;
use Illuminate\Support\Facades\Auth;

class StoreBudget
{
    private $data;

    public function __construct( $data )
    {
        $this->data = $data;
    }

    public function create()
    {
        $budget = new Budget();

        $budget->user_id = Auth::user()->id;
        $budget->name = $this->data['name'];
        $budget->type = $this->data['type'];
        $budget->amount = $this->data['amount'];
        $budget->category_id = $this->data['category']['id'];
        $budget->frequency = $this->data['frequency'];
        $budget->renews = $this->data['renews'];

        $budget->save();

        return $budget;
    }
}