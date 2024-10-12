<?php

namespace Modules\Category\Services;

use Modules\Category\Models\Category;

class UpdateCategory
{
    public function update( $request, $category )
    {
        $category->update( $request->validated() );
    }
}