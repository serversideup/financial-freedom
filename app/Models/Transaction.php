<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'description',
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
