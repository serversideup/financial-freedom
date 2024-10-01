<?php

namespace Modules\Category\Services;

use Modules\Category\Models\Category;

class StoreCategory
{
    public function store( $request )
    {
        $category = Category::create([
            'user_id' => $request->user()->id,
            'group_id' => $request->input('group_id'),
            'name' => $request->input('name'),
            'color' => $request->input('color'),
        ]);

        return $category;
    }
}