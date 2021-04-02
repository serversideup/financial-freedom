<?php

namespace App\Services\Transactions;

use App\Models\Transactions\Transaction;
use Carbon\Carbon;

class LoadTransactions{
    private $user;
    private $query;
    private $startDate;
    private $endDate;
    private $orderBy;
    private $orderDirection;

    public function __construct( $user, $data )
    {
        $this->user = $user;
        $this->syncData( $data );
    }

    public function load()
    {
        $this->initializeQuery();
        $this->filterUser();
        $this->filterDateRange();
        $this->addAccount();
        $this->addTags();
        $this->addSplits();
        $this->orderBy();
        
        return $this->query->get();
    }

    private function initializeQuery()
    {
        $this->query = Transaction::query();
    }

    private function filterUser()
    {
        $this->query->where('user_id', '=', $this->user->id );
    }

    private function filterDateRange()
    {
        $this->query->whereBetween('date', [ $this->startDate, $this->endDate ]);
    }

    private function addAccount()
    {
        $this->query->with(['accountable' => function( $query ){
            $query->with('institution');
        }]);
    }

    private function addTags()
    {
        $this->query->with('tags');
    }

    private function addSplits()
    {
        $this->query->with(['splits' => function( $query ){
            $query->with('tags');
        }]);
    }

    private function orderBy()
    {
        $this->query->orderBy($this->orderBy, $this->orderDirection);
    }

    private function syncData( $data )
    {
        $this->startDate = isset( $data['start_date'] )
                           ? date('Y-m-d', strtotime( $data['start_date'] ) ) 
                           : Carbon::now()->firstOfMonth()->format('Y-m-d');
        
        $this->endDate = isset( $data['end_date'] )
                          ? date('Y-m-d', strtotime( $data['end_date'] ) )
                          : Carbon::now()->endOfMonth()->format('Y-m-d');

        $this->orderBy = isset( $data['order_by'] )
                            ? $data['order_by']
                            : 'date';

        $this->orderDirection = isset( $data['order_direction'] )
                                    ? $data['order_direction']
                                    : 'DESC';
    }
}