<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    protected $table = 'loans';

    public function institution()
    {
        return $this->hasOne('App\Models\Institutions\Institution', 'id', 'institution_id');
    }
}
