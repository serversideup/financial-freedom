<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Transaction extends Model
{
    use Searchable;

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

    public function category()
    {
        return $this->hasOne('App\Models\Categories\Category', 'id', 'category_id');
    }

    public function splits()
    {
        return $this->hasMany('App\Models\Transactions\Split', 'transaction_id', 'id');
    }

    public function getIsSplitAttribute()
    {
        return $this->splits()->count() > 0 ? true : false;
    }

    /**
     * Get the name of the index associated with the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'transactions_index';
    }
}
