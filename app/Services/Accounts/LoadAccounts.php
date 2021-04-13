<?php

namespace App\Services\Accounts;

use App\Models\Accounts\CashAccount;
use App\Models\Accounts\CreditCard;
use App\Models\Accounts\Loan;
use App\Models\Accounts\SavingsAccount;
use App\Models\Accounts\CheckingAccount;

class LoadAccounts
{
    private $user;
    private $accounts;
    private $types;

    private $cashAccounts;
    private $creditCards;
    private $loans;
    private $savingsAccounts;
    private $checkingAccounts;

    public function __construct( $user, $types = [] )
    {
        $this->user = $user;
        $this->accounts = [];
        $this->types = $types;
    }

    public function load()
    {
        $this->loadCashAccounts();
        $this->loadCreditCards();
        $this->loadLoans();
        $this->loadSavingsAccounts();
        $this->loadCheckingAccounts();

        return [
            'cash_accounts' => $this->cashAccounts,
            'credit_cards' => $this->creditCards,
            'loans' => $this->loans,
            'savings_accounts' => $this->savingsAccounts,
            'checking_accounts' => $this->checkingAccounts
        ];
    }

    private function loadCashAccounts()
    {
        if( empty( $this->types ) || in_array( 'cash', $this->types ) ){
            $this->cashAccounts = CashAccount::where('user_id', '=', $this->user->id)
                                            ->get();
        }
    }

    private function loadCreditCards()
    {
        if( empty( $this->types ) || in_array( 'credit-cards', $this->types ) ){
            $this->creditCards = CreditCard::where('user_id', '=', $this->user->id)
                                            ->with('institution')
                                            ->get();
        }
    }

    private function loadLoans()
    {
        if( empty( $this->types ) || in_array( 'loans', $this->types ) ){
            $this->loans = Loan::where('user_id', '=', $this->user->id)
                                ->with('institution')
                                ->get();
        }
    }

    private function loadSavingsAccounts()
    {
        if( empty( $this->types ) || in_array( 'savings', $this->types ) ){
            $this->savingsAccounts = SavingsAccount::where('user_id', '=', $this->user->id)
                                                    ->with('institution')
                                                    ->get();
        }
    }

    private function loadCheckingAccounts()
    {
        if( empty( $this->types ) || in_array('checking', $this->types ) ){
            $this->checkingAccounts = CheckingAccount::where('user_id', '=', $this->user->id)
                                                     ->with('institution')
                                                     ->get();
        }
    }
}