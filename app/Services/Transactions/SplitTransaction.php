<?php

namespace App\Services\Transactions;

use App\Models\Transactions\Transaction;
use App\Models\Transactions\Split;

class SplitTransaction
{
    private $transaction;
    private $amount;
    private $name;
    private $description;
    private $split;
    private $category;

    public function __construct( $data, $transactionID )
    {
        $this->syncLocal( $data, $transactionID );
    }

    public function split()
    {
        $this->createSplit();

        return $this->split;
    }

    private function createSplit()
    {
        $this->split = new Split();

        $this->split->transaction_id = $this->transaction->id;
        $this->split->amount = $this->amount;
        $this->split->name = $this->name;
        $this->split->description = $this->description;
        $this->split->category_id = $this->category;

        $this->split->save();
    }

    private function syncLocal( $data, $transactionID )
    {
        $this->transaction = Transaction::where('id', '=', $transactionID)->first();

        $this->amount = number_format( $data['amount'], 2, '.', '' );
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->tags = isset( $data['tags'] ) ? json_decode( $data['tags'] ) : null;
        $this->category = $data['category'];
    }
}