<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categories\StoreCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\Categories\DeleteCategory;
use App\Services\Categories\StoreCategory;
use App\Services\Categories\UpdateCategory;
use App\Services\Groups\IndexGroups;
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
            'groups' => fn () => ( new IndexGroups() )->index( $request ),
        ]);
    }

    public function store( StoreCategoryRequest $request )
    {
        ( new StoreCategory() )->store( $request );
        return redirect()->back();
    }

    public function update( UpdateCategoryRequest $request, Category $category )
    {
        ( new UpdateCategory() )->update( $request, $category );
        return redirect()->back();
    }

    public function destroy( Category $category ): RedirectResponse
    {
        ( new DeleteCategory() )->delete( $category );
        return redirect()->back();
    }
}
