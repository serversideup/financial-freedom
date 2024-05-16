<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groups';
    
    protected $fillable = [
        'user_id',
        'name',
        'color'
    ];

    public function categories()
    {
        return $this->hasMany('App\Models\Category', 'group_id', 'id');
    }
}