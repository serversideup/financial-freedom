<?php

namespace App\Providers;

use App\Models\Team;
use App\Policies\TeamPolicy;

use App\Models\Accounts\SavingsAccount;
use App\Policies\SavingsAccountPolicy;
use App\Models\Accounts\CheckingAccount;
use App\Policies\CheckingAccountPolicy;
use App\Models\Transactions\Transaction;
use App\Policies\TransactionPolicy;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Team::class => TeamPolicy::class,
        SavingsAccount::class => SavingsAccountPolicy::class,
        CheckingAccount::class => CheckingAccountPolicy::class,
        Transaction::class => TransactionPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
