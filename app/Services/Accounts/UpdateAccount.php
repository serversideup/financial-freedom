<?php

namespace App\Services\Accounts;

use App\Models\Accounts\CashAccount;
use App\Models\Accounts\CheckingAccount;
use App\Models\Accounts\Loan;
use App\Models\Accounts\CreditCard;
use App\Models\Accounts\SavingsAccount;

class UpdateAccount
{
    private $user;
    private $name;
    private $number;
    private $description;
    private $currentBalance;

    public function __construct( $user, $data  )
    {
        $this->user = $user;
        $this->hydrateLocal( $data );
    }

    public function update( $id, $type )
    {
        switch( $type ){
            case 'savings-account':
                return $this->updateSavingsAccount( $id );
            break;
            case 'checking-account':
                return $this->updateCheckingAccount( $id );
            break;
            case 'cash-account':
                return $this->updateCashAccount( $id );
            break;
            case 'loan':
                return $this->updateLoan( $id );
            break;
            case 'credit-card':
                return $this->updateCreditCard( $id );
            break;
        }
    }

    private function hydrateLocal( $data )
    {
        $this->name = $data['name'];
        $this->number = isset( $data['number'] ) ? $data['number'] : '';
        $this->description = $data['description'];
        $this->currentBalance = $data['current_balance'];
    }

    private function updateSavingsAccount( $id )
    {
        $savingsAccount = SavingsAccount::where('id', '=', $id)->first();

        $savingsAccount->name = $this->name;
        $savingsAccount->number = $this->number;
        $savingsAccount->description = $this->description;
        $savingsAccount->current_balance = $this->currentBalance;
        
        $savingsAccount->save();
    }

    private function updateCheckingAccount( $id )
    {
        $checkingAccount = CheckingAccount::where('id', '=', $id)->first();

        $checkingAccount->name = $this->name;
        $checkingAccount->number = $this->number;
        $checkingAccount->description = $this->description;
        $checkingAccount->current_balance = $this->currentBalance;
        
        $checkingAccount->save();
    }

    private function updateCashAccount( $id )
    {
        $cashAccount = CashAccount::where('id', '=', $id)->first();

        $cashAccount->name = $this->name;
        $cashAccount->description = $this->description;
        $cashAccount->current_balance = $this->currentBalance;

        $cashAccount->save();
    }

    private function updateLoan( $id )
    {
        $loan = Loan::where('id', '=', $id)->first();

        $loan->name = $this->name;
        $loan->number = $this->number;
        $loan->description = $this->description;
        $loan->current_balance = $this->currentBalance;

        $loan->save();
    }

    private function updateCreditCard( $id )
    {
        $creditCard = CreditCard::where('id', '=', $id)->first();

        $creditCard->name = $this->name;
        $creditCard->number = $this->number;
        $creditCard->description = $this->description;
        $creditCard->current_balance = $this->currentBalance;

        $creditCard->save();
    }
}