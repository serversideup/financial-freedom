<?php

namespace Modules\Category\Services;

use Modules\Category\Models\Group;
use Modules\Category\Http\Requests\StoreGroupRequest;
class StoreGroup
{
    public function store(StoreGroupRequest $request)
    {
        Group::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'color' => $request->color
        ]);
    }
}
