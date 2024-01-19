<?php

namespace App\Console\Commands;

use App\Services\Institutions\SeedInstitutions;
use Illuminate\Console\Command;

class SetUpInstitutions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ff:set-up-institutions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set up the institutions used by financial freedom.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        ( new SeedInstitutions() )->seedUnitedStates();
    }
}
