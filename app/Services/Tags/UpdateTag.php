<?php

namespace App\Services\Tags;

class UpdateTag
{
    private $user;
    private $tag;
    private $name;
    private $color;

    public function __construct( $user, $tag, $data )
    {
        $this->user = $user;
        $this->tag = $tag;
        $this->syncLocal( $data );
    }

    public function update()
    {
        $this->tag->name = $this->name;
        $this->tag->color = $this->color;

        $this->tag->save();

        return $this->tag;
    }

    private function syncLocal( $data )
    {
        $this->name = $data['name'];
        $this->color = $data['color'];
    }
}