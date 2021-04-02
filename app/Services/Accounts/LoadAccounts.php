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
    private $cashAccounts;
    private $creditCards;
    private $loans;
    private $savingsAccounts;
    private $checkingAccounts;

    public function __construct( $user )
    {
        $this->user = $user;
        $this->accounts = [];
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
        $this->cashAccounts = CashAccount::where('user_id', '=', $this->user->id)
                                          ->get();
    }

    private function loadCreditCards()
    {
        $this->creditCards = CreditCard::where('user_id', '=', $this->user->id)
                                        ->with('institution')
                                        ->get();
    }

    private function loadLoans()
    {
        $this->loans = Loan::where('user_id', '=', $this->user->id)
                            ->with('institution')
                            ->get();
    }

    private function loadSavingsAccounts()
    {
        $this->savingsAccounts = SavingsAccount::where('user_id', '=', $this->user->id)
                                                ->with('institution')
                                                ->get();
    }

    private function loadCheckingAccounts()
    {
        $this->checkingAccounts = CheckingAccount::where('user_id', '=', $this->user->id)
                                                ->with('institution')
                                                ->get();
    }
}