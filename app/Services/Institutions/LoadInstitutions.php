<?php

namespace App\Services\Institutions;

use App\Models\Institutions\Institution;

class LoadInstitutions
{
    private $query;

    public function __construct()
    {

    }

    public function load()
    {
        $this->initializeQuery();
        $this->orderBy();

        return $this->query->get();
    }

    private function initializeQuery()
    {
        $this->query = Institution::query();
    }

    private function orderBy()
    {
        $this->query->orderBy('name', 'ASC');
    }
}