<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\Categories\SeedUserCategories;
use Illuminate\Console\Command;

class SeedCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ff:seed-categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seeds the categories for each user.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();

        foreach( $users as $user ){
            ( new SeedUserCategories() )->seed( $user );
        }
    }
}
