<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $incrementing = true;

    protected $table = 'categories';
    protected $appends = ['parent_name'];
    
    public function subCategories()
    {
        return $this->hasMany('App\Models\Categories\Category', 'parent_id');
    }

    public function parentCategory()
    {
        return $this->hasOne('App\Models\Categories\Category', 'id', 'parent_id');
    }

    public function getParentNameAttribute()
    {
        return $this->parent_id != null ? $this->parentCategory->name : '';
    }
}