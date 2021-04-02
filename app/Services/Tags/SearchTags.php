<?php

namespace App\Services\Tags;

use App\Models\Tags\Tag;

class SearchTags
{
    private $user;
    private $term;
    private $query;

    public function __construct( $user, $term )
    {
        $this->user = $user;
        $this->term = $term;
        $this->query = Tag::query();
    }

    public function search()
    {
        $this->filterName();
        $this->filterUser();
        $this->applyLimit();
        
        return $this->query->get();
    }

    private function filterName()
    {
        $this->query->where('name', 'LIKE', '%'.$this->term.'%');
    }

    private function filterUser()
    {
        $this->query->where('user_id', '=', $this->user->id);
    }

    private function applyLimit()
    {
        $this->query->take(20);
    }
}