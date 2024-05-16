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

    protected $appends = ['type'];

    protected $casts = [
        'import_map' => 'object'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function institution()
    {
        return $this->hasOne(Institution::class, 'id', 'institution_id');
    }

    public function rules()
    {
        return $this->morphMany(Rule::class, 'accountable');
    }

    public function getTypeAttribute()
    {
        return 'credit-card';
    }
}