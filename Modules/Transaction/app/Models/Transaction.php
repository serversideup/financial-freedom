<?php

namespace Modules\Transaction\Models;

use Modules\Category\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'accountable_id',
        'accountable_type',
        'category_id',
        'amount',
        'date',
        'merchant',
        'notes',
        'type',
        'reconciled',
        'receipt_url',
        'original'
    ];

    public function accountable()
    {
        return $this->morphTo();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
