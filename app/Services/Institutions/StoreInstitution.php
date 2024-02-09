<?php

namespace App\Services\Institutions;

use App\Models\Institution;

class StoreInstitution
{
    public function store( $request )
    {
        $institution = Institution::create([
            'name' => $request->input('name'),
            'url' => $request->input('url', ''),
        ]);

        return $institution;
    }
}