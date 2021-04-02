<?php

namespace App\Http\Controllers\API\Tags;

use App\Http\Controllers\Controller;
use Auth;
use Request;
use App\Services\Tags\SearchTags;

class TagsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $searchTags = new SearchTags( Auth::user(), Request::get('search') );
        $tags = $searchTags->search();

        return response()->json( $tags );
    }
}