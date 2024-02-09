<?php

namespace App\Services\Institutions;

class DeleteInstitution
{
    public function delete( $institution )
    {
        $institution->delete();
    }
}