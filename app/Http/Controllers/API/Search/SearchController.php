<?php

namespace App\Http\Controllers\API\Search;

use App\Http\Controllers\Controller;
use App\Services\Search\AppSearch;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
    }

    public function index( \Illuminate\Http\Request $request )
    {
        $results = ( new AppSearch( $request->get('term') ) )->search();
        return response()->json( $results );
    }

}