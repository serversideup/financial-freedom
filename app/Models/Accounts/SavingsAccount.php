<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Model;

class SavingsAccount extends Model
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    protected $table = 'savings_accounts';

    public function institution()
    {
        return $this->hasOne('App\Models\Institutions\Institution', 'id', 'institution_id');
    }
}
