<?php

namespace App\Services\Categories;

class DeleteCategory
{
    public function delete( $category )
    {
        $this->deleteSubCategories( $category );
        $this->deleteCategory( $category );
    }

    private function deleteSubCategories( $category )
    {
        if ( $category->subCategories->count() > 0 ) {
            foreach ( $category->subCategories as $subCategory ) {
                $this->deleteCategory( $subCategory );
            }
        }
    }
    private function deleteCategory( $category )
    {
       $category->delete();
    }
}