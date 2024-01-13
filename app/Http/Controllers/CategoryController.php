<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Settings/Categories/Index', [
            'group' => 'settings',
            'subGroup' => 'categories'
        ]);
    }

    public function update()
    {
        return redirect()->back();
    }
}
