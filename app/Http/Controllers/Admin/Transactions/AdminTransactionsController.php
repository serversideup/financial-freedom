<?php

namespace App\Http\Controllers\Admin\Transactions;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\Tags\Tag;
use App\Models\Categories\Category;
use App\Models\Transactions\NamingRule;
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
        return Inertia::render('Admin/Transactions/Index');
    }

    public function categories()
    {
        $categories = Category::with('subCategories')
                              ->where('parent_id', '=', null)
                              ->orderBy('name')
                              ->get();

        return Inertia::render('Admin/Transactions/Categories', [
            'categories' => $categories
        ]);
    }

    public function tags()
    {
        $tags = Tag::where( 'user_id', '=', Auth::user()->id )
                    ->orderBy('name', 'asc')
                    ->get();

        return Inertia::render('Admin/Transactions/Tags', [
            'tags' => $tags
        ]);
    }

    public function rules()
    {
        return Inertia::render('Admin/Transactions/Rules');
    }
}