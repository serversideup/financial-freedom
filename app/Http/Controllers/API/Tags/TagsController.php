<?php

namespace App\Http\Controllers\API\Tags;

use App\Http\Controllers\Controller;
use Auth;
use Request;
use App\Models\Tags\Tag;
use App\Services\Tags\SearchTags;
use App\Services\Tags\UpdateTag;

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

    public function update( Tag $tag )
    {
        $updateTag = new UpdateTag( Auth::user(), $tag, Request::all() );
        $updateTag->update();

        return response()->json('', 201);
    }
}