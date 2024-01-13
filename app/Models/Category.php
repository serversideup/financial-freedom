<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $appends = ['parent_name'];
    protected $fillable = [
        'user_id',
        'parent_id',
        'name',
        'color'
    ];

    public function subCategories()
    {
        return $this->hasMany('App\Models\Category', 'parent_id');
    }

    public function parentCategory()
    {
        return $this->hasOne('App\Models\Category', 'id', 'parent_id');
    }

    public function getParentNameAttribute()
    {
        return $this->parent_id != null ? $this->parentCategory->name : '';
    }
}