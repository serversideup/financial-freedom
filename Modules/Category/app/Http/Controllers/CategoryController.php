<?php

namespace Modules\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Category\Http\Requests\StoreCategoryRequest;
use Modules\Category\Http\Requests\UpdateCategoryRequest;
use Modules\Category\Services\DeleteCategory;
use Modules\Category\Services\StoreCategory;
use Modules\Category\Services\UpdateCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Category\Models\Category;
use Modules\Category\Services\IndexGroups;

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
