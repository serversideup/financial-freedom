<?php

namespace Modules\Initialize\Console;

use GuzzleHttp\Promise\Create;
use Illuminate\Console\Command;
use Modules\Initialize\Actions\CreateAccounts;
use Modules\Initialize\Actions\CreateTransactions;
use Modules\Initialize\Actions\CreateUser;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class InitializeDemo extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'ff:initialize-demo';

    /**
     * The console command description.
     */
    protected $description = 'Initializes a demo of Financial Freedom.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->warn('WARNING: This will clear all data in the database and replace it with demo data.');
        if ($this->confirm('Do you wish to continue?')) {
            $this->info('🔁 Initializing demo...');
            
            // Clear all data
            $this->call('migrate:refresh');

            $name = $this->ask('Enter the name of the admin user');
            $email = $this->ask('Enter a email for the admin user');
            $password = $this->secret('Enter a password for the admin user');

            $this->info('👤 Creating user...');
            $user = ( new CreateUser() )->handle($name, $email, $password);

            $this->info('🏦 Setting up institutions...');
            $this->call('ff:set-up-institutions');
            
            $this->info('🏷️ Seeding groups & categories...');
            $this->call('ff:seed-categories');

            $this->info('💰 Creating accounts...');
            ( new CreateAccounts($user) )->handle();

            // Create Transactions
            $this->info('💸 Creating transactions...');
            ( new CreateTransactions($user) )->handle();

            // Create Rules
            $this->info('🎉 Demo initialized successfully.');
        } else {
            $this->info('❌ Demo initialization cancelled.');
        }
    }

    /**
     * Get the console command arguments.
     */
    protected function getArguments(): array
    {
        return [
            ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     */
    protected function getOptions(): array
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
