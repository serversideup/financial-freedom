<?php

namespace App\Services\Accounts;

use App\Models\Accounts\CashAccount;
use App\Models\Accounts\CheckingAccount;
use App\Models\Accounts\CreditCard;
use App\Models\Accounts\Loan;
use App\Models\Accounts\SavingsAccount;

class ShowAccount
{
    private $user;
    private $accountID;
    private $accountType;
    private $query;

    public function __construct( $user, $accountID, $accountType )
    {
        $this->user = $user;
        $this->accountID = $accountID;
        $this->accountType = $accountType;
    }

    public function show()
    {
        $this->initializeQuery();
        $this->filterID();
        $this->filterUser();
        $this->bindInstitution();
        $this->bindTransactions();
        $this->bindAllocations();

        return $this->query->first();
    }

    private function initializeQuery()
    {
        switch( $this->accountType ){
            case 'checking':
                $this->query = CheckingAccount::query();
            break;
            case 'savings':
                $this->query = SavingsAccount::query();
            break;
            case 'cash':
                $this->query = CashAccount::query();
            break;
            case 'loan':
                $this->query = Loan::query();
            break;
            case 'credit-card':
                $this->query = CreditCard::query();
            break;
        }
    }

    private function filterID()
    {
        $this->query->where('id', '=', $this->accountID);
    }

    private function filterUser()
    {
        $this->query->where('user_id', '=', $this->user->id);
    }

    private function bindInstitution()
    {
        $this->query->with('institution');
    }

    private function bindTransactions()
    {
        $this->query->with('transactions');
    }

    private function bindAllocations()
    {
        if( in_array( $this->accountType, ['checking', 'savings', 'cash'] ) ){
            $this->query->with('allocations');
        }
    }
}