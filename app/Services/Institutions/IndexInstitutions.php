<?php

namespace App\Services\Institutions;

use App\Models\Institution;

class IndexInstitutions
{
    private $request;
    private $query;
    private $paginate = true;
    private $take = 10;

    public function index( $request )
    {
        $this->request = $request;
        $this->query = Institution::query();

        $this->applyOrder();

        if( $this->paginate ){
            $institutions = $this->query->paginate( $this->take );
        }else{
            $institutions = $this->query->get();
        }

        return $institutions;
    }

    private function applyOrder()
    {
        $this->query->orderBy( 
            $this->request->input('orderBy', 'name'),
            $this->request->input('orderDirection', 'asc')
        );
    }
}