<?php

namespace Modules\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Category\Http\Requests\StoreGroupRequest;
use Modules\Category\Http\Requests\UpdateGroupRequest;
use Modules\Category\Models\Group;
use Modules\Category\Services\StoreGroup;
use Modules\Category\Services\UpdateGroup;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function store(StoreGroupRequest $request)
    {
        (new StoreGroup())->store($request);
        return redirect()->back();
    }

    public function update(UpdateGroupRequest $request, Group $group)
    {
        (new UpdateGroup())->update($request, $group);
        return redirect()->back();
    }
}
