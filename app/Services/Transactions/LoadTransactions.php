<?php

namespace App\Services\Transactions;

use App\Models\Transactions\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class LoadTransactions{
    private $user;
    private $account;
    private $query;
    private $startDate;
    private $endDate;
    private $orderBy;
    private $orderDirection;

    public function __construct( $user, $data, $account = null )
    {
        $this->user = $user;
        
        if( $account ){
            $this->account = $account;
        }

        $this->syncData( $data );
    }

    public function load()
    {
        $this->initializeQuery();
        $this->filterUser();
        $this->filterDateRange();
        $this->filterAccount();
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

    private function filterAccount()
    {
        if( $this->account ){
            $this->query->whereHasMorph( 
                'accountable', 
                [get_class( $this->account ), Transaction::class ],
                function( Builder $query ){
                    $query->where('accountable_id', '=', $this->account->id);
                }
            );
        }
    }

    private function addAccount()
    {
        if( !$this->account ){
            $this->query->with(['accountable' => function( $query ){
                $query->with('institution');
            }]);
        }
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