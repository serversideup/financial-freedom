<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Model;

class Split extends Model
{
    public $incrementing = true;

    protected $table = 'transactions_splits';

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tags\Tag', 'transactions_splits_tags', 'transaction_split_id', 'tag_id')
                    ->withTimestamps();
    }

    public function transaction()
    {
        return $this->belongsTo('App\Models\Transactions\Transaction', 'transaction_id', 'id');
    }

    public function category()
    {
        return $this->hasOne('App\Models\Categories\Category', 'id', 'category_id');
    }
}