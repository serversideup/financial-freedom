<?php

namespace App\Services\Institutions;

use App\Models\Institution;

class UpdateInstitution
{
    public function update( $request, $institution )
    {
        $institution->update([
            'name' => $request->input('name'),
            'url' => $request->input('url', ''),
        ]);

        return $institution;
    }
}