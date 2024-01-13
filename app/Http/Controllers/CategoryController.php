<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\Categories\DeleteCategory;
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

    public function destroy( Category $category ): RedirectResponse
    {
        ( new DeleteCategory() )->delete( $category );
        return redirect()->back();
    }
}
