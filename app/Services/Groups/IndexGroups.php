<?php

namespace App\Services\Groups;

use App\Models\Group;

class IndexGroups
{
    private $request;

    public function index( $request )
    {
        $groups = Group::with('categories')->get();

        return $groups;
    }
}