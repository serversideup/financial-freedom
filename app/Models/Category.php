<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    
    protected $fillable = [
        'user_id',
        'group_id',
        'name',
        'color'
    ];

    public function group()
    {
        return $this->hasOne('App\Models\Group', 'id', 'group_id');
    }
}