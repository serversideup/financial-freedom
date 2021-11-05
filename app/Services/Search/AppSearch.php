<?php

namespace App\Services\Search;

use App\Models\Transactions\Transaction;
use App\Models\Accounts\CashAccount;
use App\Models\Accounts\CreditCard;
use App\Models\Accounts\Loan;
use App\Models\Accounts\CheckingAccount;
use App\Models\Accounts\SavingsAccount;

class AppSearch
{
    private $term;
    private $results;

    public function __construct( $term )
    {
        $this->term = $term;
    }

    public function search()
    {
        $this->searchTransactions();
        $this->searchCashAccounts();
        $this->searchCreditCards();
        $this->searchLoans();
        $this->searchCheckingAccounts();
        $this->searchSavingsAccounts();

        return $this->results;
    }

    private function searchTransactions()
    {
        $this->results['transactions'] = Transaction::search( $this->term )
                                                    ->query( function( $builder ){
                                                        $builder->with('category')
                                                                ->with(['splits' => function( $query ){
                                                                    $query->with('category');
                                                                }]);
                                                    })
                                                    ->take(10)
                                                    ->get();
        
    }

    private function searchCashAccounts()
    {

    }

    private function searchCreditCards()
    {

    }

    private function searchLoans()
    {

    }

    private function searchCheckingAccounts()
    {

    }

    private function searchSavingsAccounts()
    {

    }

}