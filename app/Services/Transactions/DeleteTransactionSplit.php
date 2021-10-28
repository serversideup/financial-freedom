<?php

namespace App\Services\Transactions;

class DeleteTransactionSplit
{
    private $split;

    public function __construct( $split )
    {
        $this->split = $split;
    }

    public function delete()
    {
        $this->split->delete();

        return true;
    }
}