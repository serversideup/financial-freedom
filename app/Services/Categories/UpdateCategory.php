<?php

namespace App\Services\Categories;

class UpdateCategory
{
    private $category;
    private $data;

    public function __construct( $category, $data )
    {
        $this->category = $category;
        $this->data = $data;
    }

    public function update()
    {
        $this->category->name = $this->data['name'];
        $this->category->color = $this->data['color'];

        $this->category->save();

        return $this->category;
    }
}