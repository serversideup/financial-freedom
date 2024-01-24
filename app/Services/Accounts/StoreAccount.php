<?php

namespace App\Services\Accounts;

use App\Data\CashAccountData;
use App\Data\CreditCardData;
use App\Data\LoanData;
use App\Services\CashAccounts\StoreCashAccount;

class StoreAccount
{
    public function store( $request )
    {
        switch( $request->get('account_type') ){
            case 'cash':
                $cashAccount = CashAccountData::fromCreateRequest( $request );
                ( new StoreCashAccount() )->store( $cashAccount );
                break;
            case 'loan':
                // $account = LoanData::fromRequest( $request );
                break;
            case 'credit_card':
                // $account = CreditCardData::fromRequest( $request );
                break;
        }

    }
}