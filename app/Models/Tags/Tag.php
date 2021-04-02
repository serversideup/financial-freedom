<?php

namespace App\Models\Tags;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $incrementing = true;

    protected $table = 'tags';
    protected $fillable = ['user_id', 'name'];
}