<?php

namespace App\Services\Categories;

use App\Models\Categories\Category;

class LoadCategories
{
    private $flatten;
    private $children;
    private $query;
    private $categories;

    public function __construct( $options )
    {
        $this->setOptions( $options );
        $this->query = Category::query();
    }

    public function load()
    {
        $this->applyChildren();
        $this->order();

        $this->categories = $this->query->get();

        $this->flatten();

        return $this->categories;
    }

    public function setOptions( $options )
    {
        $this->flatten = isset( $options['flatten'] ) ? $options['flatten'] : false;
        $this->children = isset( $options['children'] ) ? $options['children'] : true;
    }

    private function applyChildren()
    {
        if( $this->children ){
            $this->query->with('subCategories')
                        ->where('parent_id', '=', null);
        }
    }

    private function order()
    {
        $this->query->orderBy('name');
    }

    private function flatten()
    {
        $categories = [];

        if( $this->flatten ){
            foreach( $this->categories as $category ){
                $tempCategory = $category->toArray();
                $tempCategory['sub_categories'] = null;

                array_push( $categories, $tempCategory );

                foreach( $category->subCategories as $subCategory ){
                    $categoryArray = $subCategory->toArray();
                    unset( $categoryArray['parent_category'] );

                    array_push( $categories, $categoryArray );
                }
            }
        }

        $this->categories = $categories;
    }
}