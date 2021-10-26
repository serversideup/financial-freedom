<?php

namespace App\Services\Transactions;

use App\Models\Transactions\Transaction;

class ShowTransaction
{
    private $user;
    private $transactionID;
    private $query;
    
    public function __construct( $user, $transactionID )
    {
        $this->user = $user;
        $this->transactionID = $transactionID;
    }

    public function show()
    {
        $this->initializeQuery();
        $this->filterTransaction();
        $this->addAccount();
        $this->addSplits();
        $this->addTags();
        

        return $this->query->first();
    }

    private function initializeQuery()
    {
        $this->query = Transaction::query();
    }

    private function filterTransaction()
    {
        $this->query->where('id', '=', $this->transactionID);
    }

    private function addAccount()
    {
        $this->query->with(['accountable' => function( $query ){
            $query->with('institution');
        }]);
    }

    private function addSplits()
    {
        $this->query->with(['splits' => function( $query ){
            $query->with('category');
        }]);
    }

    private function addTags()
    {
        $this->query->with('tags');
    }
}