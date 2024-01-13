<?php

namespace App\Http\Controllers;

use App\Services\Categories\IndexCategories;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function index( Request $request )
    {
        return Inertia::render('Settings/Categories/Index', [
            'group' => 'settings',
            'subGroup' => 'categories',
            'categories' => fn () => ( new IndexCategories() )->index( $request ),
        ]);
    }

    public function update()
    {
        return redirect()->back();
    }
}
