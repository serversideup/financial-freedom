<?php

namespace App\Http\Controllers\API\Categories;

use App\Http\Controllers\Controller;
use App\Models\Categories\Category;
use App\Services\Categories\UpdateCategory;
use Request;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function update( Category $category )
    {
        ( new UpdateCategory( $category, Request::all() ) )->update();

        return response()->json( '', 201 );
    }
}