<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashAccount extends Model
{
    use HasFactory;

    protected $table = 'cash_accounts';
    
    protected $fillable = [
        'user_id',
        'institution_id',
        'type',
        'name',
        'description',
        'account_number',
        'balance',
        'interest_rate'
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