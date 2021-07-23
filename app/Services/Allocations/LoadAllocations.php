<?php

namespace App\Services\Allocations;

use App\Models\Accounts\CheckingAccount;
use App\Models\Accounts\CashAccount;
use App\Models\Accounts\SavingsAccount;

class LoadAllocations
{
    private $type;
    private $id;
    private $account;
    
    public function __construct( $type, $id )
    {
        $this->type = $type;
        $this->id = $id;
    }

    public function load()
    {
        $this->loadAccount();
        
        return $this->account->allocations;
    }

    private function loadAccount()
    {
        switch( $this->type ){
            case 'checking':
                $this->account = CheckingAccount::where('id', '=', $this->id)
                                    ->with('allocations')
                                    ->first();
            break;
            case 'cash':
                $this->account = CashAccount::where('id', '=', $this->id)
                                    ->with('allocations')
                                    ->first();
            break;
            case 'savings':
                $this->account = SavingsAccount::where('id', '=', $this->id)
                                    ->with('allocations')
                                    ->first();
            break;
        }
    }
}