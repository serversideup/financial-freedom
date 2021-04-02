<?php

namespace App\Services\Institutions;

use App\Models\Institutions\Institution;

use Storage;

class StoreInstitution
{
    private $name;
    private $logo;

    public function __construct( $data )
    {
        $this->syncLocal( $data );
    }

    public function store()
    {
        $institution = new Institution();

        $institution->name = $this->name;

        if( $this->logo ){
            $institution->logo = $this->saveLogo( $this->logo );
        }

        $institution->save();

        return $institution;
    }

    private function saveLogo( $logo )
    {
        $path = Storage::put( '/public/institutions', $logo );
        $fileURL = env('APP_URL').'/storage/'.str_replace( 'public/', '', $path );

        return $fileURL;
    }

    private function syncLocal( $data )
    {
        $this->name = $data['institution_name'];
        $this->logo = $data['logo'] ? $data['logo'] : '';
    }
}