<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    use HasFactory;

    protected $table = 'credit_cards';
    
    protected $fillable = [
        'user_id',
        'institution_id',
        'brand',
        'name',
        'description',
        'interest_rate',
        'credit_limit',
        'balance'
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function institution()
    {
        return $this->hasOne('App\Models\Institution', 'id', 'institution_id');
    }
}