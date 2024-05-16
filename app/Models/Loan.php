<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $table = 'loans';
    
    protected $fillable = [
        'user_id',
        'institution_id',
        'name',
        'type',
        'description',
        'opened_at',
        'interest_rate',
        'remaining_balance',
        'original_balance',
        'payment_amount'
    ];

    protected $appends = ['type'];

    protected $casts = [
        'import_map' => 'object'
    ];
    
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function institution()
    {
        return $this->hasOne('App\Models\Institution', 'id', 'institution_id');
    }

    public function rules()
    {
        return $this->morphMany(Rule::class, 'accountable');
    }

    public function getTypeAttribute()
    {
        return 'loan';
    }
}