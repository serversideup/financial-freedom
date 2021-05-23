<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Model;

class CashAccount extends Model
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    protected $table = 'cash_accounts';

    protected $appends = ['account_type'];
    
    public function transactions()
    {
        return $this->morphMany('App\Models\Transactions\Transaction', 'accountable');
    }

    public function allocations()
    {
        return $this->morphMany('App\Models\Allocations\Allocation', 'accountable');
    }

    public function getAccountTypeAttribute()
    {
        return 'cash';
    }
}
