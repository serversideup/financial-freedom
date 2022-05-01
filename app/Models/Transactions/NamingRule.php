<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Model;

class NamingRule extends Model
{
    public $incrementing = true;

    protected $table = 'transactions_naming_rules';

    public function category()
    {
        return $this->hasOne('App\Models\Categories\Category', 'id', 'category_id');
    }
}