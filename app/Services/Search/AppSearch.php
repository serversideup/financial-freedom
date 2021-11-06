<?php

namespace App\Services\Search;

use App\Models\Transactions\Transaction;
use App\Models\Accounts\CashAccount;
use App\Models\Accounts\CreditCard;
use App\Models\Accounts\Loan;
use App\Models\Accounts\CheckingAccount;
use App\Models\Accounts\SavingsAccount;
use MeiliSearch\Endpoints\Indexes;
use Auth;

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
        $this->results['transactions'] = Transaction::search( $this->term, function( Indexes $meilisearch, string $query, array $options ){
                                                        $options['filter'] = [
                                                            'user_id='.Auth::user()->id
                                                        ];

                                                        return $meilisearch->search( $query, $options );
                                                    } )->query( function( $builder ){
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
        $this->results['cash_accounts'] = CashAccount::search( $this->term, function( Indexes $meilisearch, string $query, array $options ){
            $options['filter'] = [
                'user_id='.Auth::user()->id
            ];

            return $meilisearch->search( $query, $options );
        } )->get();
    }

    private function searchCreditCards()
    {
        $this->results['credit_cards'] = CreditCard::search( $this->term, function( Indexes $meilisearch, string $query, array $options ){
            $options['filter'] = [
                'user_id='.Auth::user()->id
            ];

            return $meilisearch->search( $query, $options );
        } )->get();
    }

    private function searchLoans()
    {
        $this->results['loans'] = Loan::search( $this->term, function( Indexes $meilisearch, string $query, array $options ){
            $options['filter'] = [
                'user_id='.Auth::user()->id
            ];

            return $meilisearch->search( $query, $options );
        } )->get();
    }

    private function searchCheckingAccounts()
    {
        $this->results['checking_accounts'] = CheckingAccount::search( $this->term, function( Indexes $meilisearch, string $query, array $options ){
            $options['filter'] = [
                'user_id='.Auth::user()->id
            ];

            return $meilisearch->search( $query, $options );
        } )->get();
    }

    private function searchSavingsAccounts()
    {
        $this->results['savings_accounts'] = SavingsAccount::search( $this->term, function( Indexes $meilisearch, string $query, array $options ){
            $options['filter'] = [
                'user_id='.Auth::user()->id
            ];

            return $meilisearch->search( $query, $options );
        } )->get();
    }

}