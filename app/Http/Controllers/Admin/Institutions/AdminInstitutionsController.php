<?php

namespace App\Http\Controllers\Admin\Institutions;

use App\Http\Controllers\Controller;
use App\Models\Institutions\Institution;
use App\Services\Institutions\StoreInstitution;
use App\Services\Institutions\UpdateInstitution;
use Inertia\Inertia;

use Request;

class AdminInstitutionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('verified');
    }

    public function show()
    {
        $institutions = Institution::all();

        return Inertia::render('Admin/Institutions/Index', [
            'institutions' => $institutions
        ]);
    }

    public function edit( Institution $institution )
    {
        // $institution->load('importMapping');
        
        return Inertia::render('Admin/Institutions/Edit', [
            'csrf' => csrf_token(),
            'institution' => $institution
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Institutions/Create', [
            'csrf' => csrf_token()
        ]);
    }

    public function store()
    {

        $storeInstitution = new StoreInstitution( Request::all() );
        $storeInstitution->store();

        return redirect('/admin/institutions');
    }

    public function update( Institution $institution )
    {
        $updateInstitution = new UpdateInstitution( $institution, Request::all() );
        $updateInstitution->update();

        return redirect('/admin/institutions');
    }
}