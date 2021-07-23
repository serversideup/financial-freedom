<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StoicMoneyUpdateApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stoic-money:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates Stoic Money by running migrations, seeders, etc.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return 0;
    }
}
