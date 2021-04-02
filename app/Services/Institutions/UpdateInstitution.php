<?php

namespace App\Services\Institutions;

use Storage;

class UpdateInstitution
{
    private $institution;
    private $name;
    private $logo;

    public function __construct( $institution, $data )
    {
        $this->institution = $institution;
        $this->syncLocal( $data );
    }

    public function update()
    {
        $this->institution->name = $this->name;

        if( $this->logo ){
            $this->institution->logo = $this->saveLogo( $this->logo );
        }

        $this->institution->save();

        return $this->institution;
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