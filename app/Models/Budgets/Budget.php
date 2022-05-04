<?php

namespace App\Models\Budgets;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    public $incrementing = true;

    protected $table = 'budgets';

    public function category()
    {
        return $this->hasOne('App\Models\Categories\Category', 'id', 'category_id');
    }
}