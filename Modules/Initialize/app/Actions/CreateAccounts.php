<?php

namespace Modules\Initialize\Actions;

use App\Models\CashAccount;
use App\Models\CreditCard;
use App\Models\Loan;
use App\Models\Institution;
use App\Models\User;

class CreateAccounts 
{
    public function __construct(
        protected User $user,
    ){}

    public function handle()
    {
        $this->createCashAccounts();
        $this->createLoans();
        $this->createCreditCards();
    }

    private function createCashAccounts()
    {
        $names = [
            'Checking Account',
            'Savings Account',
            'Emergency Fund',
            'Vacation Fund',
            'Car Fund',
            'House Fund',
            'Investment Account'
        ];

        for( $i = 0; $i < 2; $i++ ) {
            $institution = Institution::inRandomOrder()->first();

            CashAccount::create([
                'user_id' => $this->user->id,
                'institution_id' => $institution->id,
                'type' => 'checking',
                'name' => $names[rand(0, 6)], 
                'description' => 'This is a checking account.',
                'balance' => rand(1000, 10000),
                'interest_rate' => 0.01,
            ]);
        }
    }

    private function createLoans()
    {

    }

    private function createCreditCards()
    {

    }
}