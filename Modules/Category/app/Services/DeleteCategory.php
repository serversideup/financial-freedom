<?php

namespace Modules\Category\Services;

class DeleteCategory
{
    public function delete( $category )
    {
        $category->delete();
    }
}