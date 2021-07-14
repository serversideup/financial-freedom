<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $incrementing = true;

    protected $table = 'categories';
}