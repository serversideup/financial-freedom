<?php

namespace App\Services\Categories;

use Modules\Category\Models\Category;

class IndexCategories
{
    private $request;
    private $query;
    private $paginate = true;
    private $take = 10;
    private $term;

    public function index( $request )
    {
        $this->request = $request;
        $this->query = Category::query();

        $this->applySearch();
        $this->applyOrder();

        if( $this->paginate ){
            $categories = $this->query->paginate( $this->take );
        }else{
            $categories = $this->query->get();
        }

        return $categories;
    }

    private function applySearch()
    {
        if( $this->request->has('term') ){
            $this->query->where( 'name', 'LIKE', "%{$this->term}%" );
        }
    }

    private function applyOrder()
    {
        $this->query->orderBy( 
            $this->request->input('orderBy', 'name'),
            $this->request->input('orderDirection', 'asc')
        );
    }
}