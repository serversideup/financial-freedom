<?php

namespace App\Http\Controllers;

use App\Http\Requests\Institutions\StoreInstitutionRequest;
use App\Http\Requests\Institutions\UpdateInstitutionRequest;
use App\Models\Institution;
use App\Services\Institutions\IndexInstitutions;
use App\Services\Institutions\DeleteInstitution;
use App\Services\Institutions\StoreInstitution;
use App\Services\Institutions\UpdateInstitution;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class InstitutionController extends Controller
{
    public function index( Request $request )
    {
        return Inertia::render('Settings/Institutions/Index', [
            'group' => 'settings',
            'subGroup' => 'institutions',
            'institutions' => fn () => ( new IndexInstitutions() )->index( $request ),
        ]);
    }

    public function store( StoreInstitutionRequest $request )
    {
        ( new StoreInstitution() )->store( $request );
        return redirect()->back();
    }

    public function update( UpdateInstitutionRequest $request, Institution $institution )
    {
        ( new UpdateInstitution() )->update( $request, $institution );
        return redirect()->back();
    }

    public function destroy( Request $request, Institution $institution ): RedirectResponse
    {
        ( new DeleteInstitution() )->delete( $institution );
        return redirect()->back();
    }
}
