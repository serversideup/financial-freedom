<?php

namespace App\Http\Controllers\Admin\Transactions;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\Tags\Tag;
use Request;
use Auth;

class AdminTransactionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
    }

    public function show()
    {
        $tags = Tag::where( 'user_id', '=', Auth::user()->id )
                    ->orderBy('name', 'asc')
                    ->get();

        return Inertia::render('Admin/Transactions/Index', [
            'tags' => $tags
        ]);
    }

}