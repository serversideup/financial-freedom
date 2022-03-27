<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class CheckingAccount extends Model
{
    use Searchable;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    protected $table = 'checking_accounts';
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

    public function importMapping()
    {
        return $this->hasOne( 'App\Models\Institutions\ImportMapping', 'id', 'institution_import_map_id' );
    }

    public function getAccountTypeAttribute()
    {
        return 'checking';
    }

    public function searchableAs()
    {
        return 'checking_accounts_index';
    }
}
