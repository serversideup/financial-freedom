<?php

namespace App\Services\Categories;

class UpdateCategory
{
    public function update( $request, $category )
    {
        $category->update( $request->validated() );
    }
}