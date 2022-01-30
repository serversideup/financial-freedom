<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class GiftCard extends Model
{
    use Searchable;

    public $incrementing = true;

    protected $table = 'gift_cards';
    protected $appends = ['account_type'];
    
    public function transactions()
    {
        return $this->morphMany('App\Models\Transactions\Transaction', 'accountable');
    }

    public function getAccountTypeAttribute()
    {
        return 'gift-card';
    }

    public function searchableAs()
    {
        return 'gift_cards_index';
    }
}
