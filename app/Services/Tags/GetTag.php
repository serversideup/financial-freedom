<?php

namespace App\Services\Tags;

use App\Models\Tags\Tag;

class GetTag
{
    private $user;
    private $colors = ['red', 'green', 'blue', 'grey', 'purple', 'pink', 'orange'];
    private $name;

    public function __construct( $name, $user )
    {
        $this->name = $name;
        $this->user = $user;
    }

    public function get()
    {
        $tag = Tag::firstOrNew( [
            'name' => $this->name,
            'user_id' => $this->user->id
        ] );

        if( !$tag->exists ){
            $tag->color = $this->colors[ rand( 0, 6 ) ];
        }

        $tag->save();

        return $tag;
    }
}