<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    protected $table = 'transactions';
    protected $appends = ['is_split'];

    public function accountable()
    {
        return $this->morphTo();
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tags\Tag', 'transactions_tags', 'transaction_id', 'tag_id')
                    ->withTimestamps();
    }

    public function splits()
    {
        return $this->hasMany('App\Models\Transactions\Split', 'transaction_id', 'id');
    }

    public function getIsSplitAttribute()
    {
        return $this->splits()->count() > 0 ? true : false;
    }
}
