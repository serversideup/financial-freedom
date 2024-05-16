<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SettingsController extends Controller
{
    public function index(): Response
    {
        return Inertia::render( 'Settings/Index', [
            'group' => 'settings',
            'subGroup' => 'portfolio'
        ] );
    }
}
