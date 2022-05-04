<?php

namespace App\Http\Controllers\Web\Budgets;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class BudgetsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
    }

    public function index()
    {
        return Inertia::render('Budgets/Index');
    }
}