<?php

namespace App\Services\Allocations;

use App\Models\Accounts\CheckingAccount;
use App\Models\Accounts\CashAccount;

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
            case 'checking-account':
                $this->account = CheckingAccount::where('id', '=', $this->id)
                                                ->with('allocations')
                                                ->first();
            break;
            case 'cash-account':
                $this->account = CashAccount::where('id', '=', $this->id)
                                            ->with('allocations')
                                            ->first();
            break;
        }
    }
}