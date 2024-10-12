<?php

namespace Modules\Category\Services;

use Modules\Category\Models\Group;

class IndexGroups
{
    private $request;

    public function index( $request )
    {
        $groups = Group::with('categories')
            ->where('user_id', auth()->user()->id)
            ->get();

        return $groups;
    }
}