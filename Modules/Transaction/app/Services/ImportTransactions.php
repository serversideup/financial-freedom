<?php

namespace Modules\Transaction\Services;

use App\Models\CashAccount;
use App\Models\CreditCard;
use App\Models\Loan;
use Modules\Transaction\Models\Transaction;
use Illuminate\Support\Str;

class ImportTransactions
{
    private $account;

    public function execute( $account, $transactions )
    {
        $this->findAccount( $account );
        $this->createTransactions( $transactions );
    }

    private function findAccount( $account )
    {
        switch( $account['type'] ){
            case 'cash-account':
                $this->account = CashAccount::find( $account['id'] );
            break;
            case 'credit-card':
                $this->account = CreditCard::find( $account['id'] );
            break;
            case 'loan':
                $this->account = Loan::find( $account['id'] );
            break;
        }
    }

    private function createTransactions( $transactions )
    {
        foreach( $transactions as $transaction ){
            Transaction::create([
                'uuid' => Str::uuid(),
                'user_id' => auth()->id(),
                'accountable_id' => $this->account->id,
                'accountable_type' => get_class( $this->account ),
                'category_id' => $transaction['category'] ? $transaction['category']['id'] : null,
                'amount' => $transaction['amount'],
                'date' => date( 'Y-m-d', strtotime( $transaction['date'] ) ),
                'merchant' => $transaction['name'],
                'description' => $transaction['description'],
                'type' => $transaction['direction'],
                'reconciled' => true,
                'original' => json_encode( $transaction )
            ]);
        }
    }
}