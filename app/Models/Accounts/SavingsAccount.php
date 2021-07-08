<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class SavingsAccount extends Model
{
    use Searchable;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    protected $table = 'savings_accounts';
    protected $appends = ['account_type'];
    
    public function institution()
    {
        return $this->hasOne('App\Models\Institutions\Institution', 'id', 'institution_id');
    }

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
        return 'savings';
    }

    public function searchableAs()
    {
        return 'savings_accounts_index';
    }
}
