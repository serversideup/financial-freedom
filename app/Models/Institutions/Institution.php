<?php

namespace App\Models\Institutions;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    protected $table = 'institutions';

    public function importMapping()
    {
        return $this->hasOne('App\Models\Institutions\ImportMapping', 'institution_id', 'id');
    }
}
