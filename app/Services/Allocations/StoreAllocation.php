<?php

namespace App\Services\Allocations;

use App\Models\Allocations\Allocation;

class StoreAllocation
{
    private $user;
    private $name;
    private $account;
    private $description;
    private $amount;
    private $colors = ['#f05252', '#0e9f6e', '#3f83f8', '#9061f9', '#e74694', '#ff5a1f'];
   

    public function __construct( $user, $data, $account )
    {
        $this->syncLocal( $user, $data, $account );
    }

    public function store()
    {
        $allocation = new Allocation();
        
        $allocation->user_id = $this->user->id;
        $allocation->accountable_id = $this->account->id;
        $allocation->accountable_type = get_class( $this->account );
        $allocation->name = $this->name;
        $allocation->color = $this->colors[ rand( 0, 5 ) ];
        $allocation->description = $this->description;
        $allocation->amount = $this->amount;

        $allocation->save();

        return $allocation;
    }

    private function syncLocal( $user, $data, $account )
    {
        $this->user = $user;
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->amount = $data['amount'];
        $this->account = $account;
    }
}