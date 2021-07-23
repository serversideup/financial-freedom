<?php

namespace App\Services\Allocations;

class DeleteAllocation
{
    private $user;
    private $allocation;

    public function __construct( $user, $allocation )
    {
        $this->user = $user;
        $this->allocation = $allocation;
    }

    public function delete()
    {
        $this->allocation->delete();
    }
}