<?php

namespace Modules\Category\Services;

use Modules\Category\Models\Group;
use Modules\Category\Http\Requests\UpdateGroupRequest;

class UpdateGroup
{
    public function update(UpdateGroupRequest $request, Group $group)
    {
        $group->update([
            'name' => $request->name,
            'color' => $request->color
        ]);
    }
}
