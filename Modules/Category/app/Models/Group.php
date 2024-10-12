<?php

namespace Modules\Category\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Category\Database\Factories\GroupFactory;

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
        return $this->hasMany('Modules\Category\Models\Category', 'group_id', 'id');
    }
}