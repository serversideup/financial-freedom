<?php

namespace App\Services\Rules;

use App\Data\Rules\StoreRuleData;
use App\Models\CashAccount;
use App\Models\CreditCard;
use App\Models\Loan;
use App\Models\Rule;

class StoreRule
{
    public function execute( StoreRuleData $data )
    {
        $account = $this->findAccount( $data->account );

        Rule::create([
            'accountable_id' => $account->id,
            'accountable_type' => get_class( $account ),
            'search_string' => $data->searchString,
            'replace_string' => $data->replaceString,
            'category_id' => $data->category['id'],
        ]);
    }

    private function findAccount( $account )
    {
        switch( $account['type'] ){
            case 'cash-account':
                return CashAccount::find( $account['id'] );
            break;
            case 'credit-card':
                return CreditCard::find( $account['id'] );
            break;
            case 'loan':
                return Loan::find( $account['id'] );
            break;
        }
    }
}