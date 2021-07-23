<?php

namespace App\Services\Allocations;

use App\Models\Allocations\Allocation;

class UpdateAllocations
{
    private $user;
    private $allocations;

    public function __construct( $user, $allocations )
    {
        $this->user = $user;
        $this->allocations = $allocations;
    }

    public function update()
    {
        foreach( $this->allocations as $allocation )
        {
            $updatedAllocation = Allocation::where('id', '=', $allocation['id'])
                                            ->where('user_id', '=', $allocation['user_id'])
                                            ->first();

            $updatedAllocation->name = $allocation['name'];
            $updatedAllocation->description = $allocation['description'];
            $updatedAllocation->color = $allocation['color'];
            $updatedAllocation->amount = $allocation['amount'];
            
            $updatedAllocation->save();
        }
    }
}