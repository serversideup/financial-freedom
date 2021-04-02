<?php

namespace App\Services\Transactions;

use App\Services\Transactions\AddTransaction;

class ImportTransactions
{
    private $user;
    private $account;
    private $transactions;

    public function __construct( $user, $account, $transactions )
    {
        $this->user = $user;
        $this->account = $account;
        $this->transactions = $transactions;
    }

    public function import()
    {
        foreach( $this->transactions as $transaction ){
            if( $transaction['import'] ){
                $this->persistTransaction( $transaction );
            }
        }
    }

    private function persistTransaction( $transaction )
    {

        $addTransaction = new AddTransaction(
            $this->user,
            [
                'account' => [
                    'id' => $this->account['id'],
                    'account_type' => $this->account['account_type']
                ],
                'amount' => str_replace( '-', '', $transaction['amount'] ),
                'direction' => $transaction['direction'],
                'name' => $transaction['name'],
                'date' => date('Y-m-d', strtotime( $transaction['date'] ) ),
                'description' => $transaction['description'],
                'tags' => json_encode( $transaction['tags'] )
            ]
        );

        $addTransaction->store();
    }
}