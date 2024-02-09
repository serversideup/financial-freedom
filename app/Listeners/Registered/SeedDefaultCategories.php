<?php

namespace App\Listeners\Registered;

use App\Services\Categories\SeedUserCategories;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SeedDefaultCategories
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $user = $event->user;
        
        ( new SeedUserCategories() )->seed( $user );
    }
}
