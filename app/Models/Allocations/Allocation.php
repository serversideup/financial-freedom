<?php

namespace App\Models\Allocations;

use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    public $incrementing = true;

    protected $table = 'allocations';

    public function accountable()
    {
        return $this->morphTo();
    }
}