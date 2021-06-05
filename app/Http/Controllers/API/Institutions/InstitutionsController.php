<?php

namespace App\Http\Controllers\API\Institutions;

use App\Http\Controllers\Controller;
use App\Services\Institutions\LoadInstitutions;

class InstitutionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $loadInstitutions = new LoadInstitutions();
        $institutions = $loadInstitutions->load();

        return response()->json( $institutions );
    }
}