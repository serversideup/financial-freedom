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
        ];

        for( $i = 0; $i < 2; $i++ ) {
            $institution = Institution::inRandomOrder()->first();

            CashAccount::create([
                'user_id' => $this->user->id,
                'institution_id' => $institution->id,
                'type' => 'checking',
                'name' => $names[rand(0, 1)], 
                'description' => 'This is a checking account.',
                'balance' => rand(1000, 10000),
                'interest_rate' => 0.01,
            ]);
        }
    }

    private function createLoans()
    {
        $names = [
            'Student Loan',
            'Personal Loan',
            'Auto Loan',
            'Mortgage',
        ];

        for( $i = 0; $i < 2; $i++ ) {
            $institution = Institution::inRandomOrder()->first();

            $name = $names[rand(0, 3)];

            $originalBalance = rand(10000, 100000);

            Loan::create([
                'user_id' => $this->user->id,
                'institution_id' => $institution->id,
                'type' => strtolower(str_replace(' ', '-', $name) ),
                'name' => $name, 
                'description' => 'This is a loan.',
                'opened_at' => now(),
                'interest_rate' => 0.05,
                'original_balance' => $originalBalance,
                'payment_amount' => number_format( $originalBalance / 72, 2, '.', '' ),
                'remaining_balance' => number_format( $originalBalance - ( ( $originalBalance / 72 ) * 12 ), 2, '.', '' ), // Paid for a year.
            ]);
        }
    }

    private function createCreditCards()
    {
        $names = [
            'Rewards Card',
            'Travel Card',
            'Cash Back Card',
            'Business Card',
        ];

        $brands = [
            'visa',
            'mastercard',
            'discover',
            'american-express',
        ];

        for( $i = 0; $i < 2; $i++ ) {
            $institution = Institution::inRandomOrder()->first();

            CreditCard::create([
                'user_id' => $this->user->id,
                'institution_id' => $institution->id,
                'brand' => $brands[rand(0, 3)],
                'name' => $names[rand(0, 3)],
                'description' => 'This is a credit card.',
                'credit_limit' => rand(1000, 10000),
                'balance' => rand(0, 1000),
                'interest_rate' => 0.18,
            ]);
        }
    }
}