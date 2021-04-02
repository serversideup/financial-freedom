<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class AdminReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
    }

    public function show()
    {
        return Inertia::render('Admin/Show');
    }
}