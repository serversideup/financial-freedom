<?php

namespace App\Services\Categories;

class DeleteCategory
{
    public function delete( $category )
    {
        $category->delete();
    }
}