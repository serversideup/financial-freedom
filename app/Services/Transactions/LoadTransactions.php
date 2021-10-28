<?php

namespace App\Services\Transactions;

use App\Models\Transactions\Transaction;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Accounts\CashAccount;
use App\Models\Accounts\CreditCard;
use App\Models\Accounts\Loan;
use App\Models\Accounts\CheckingAccount;
use App\Models\Accounts\SavingsAccount;
use Carbon\Carbon;

class LoadTransactions{
    private $user;
    private $account;
    private $tags;
    private $direction;
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
        $this->filterTags();
        $this->filterCategory();
        $this->filterDirection();
        $this->filterUser();
        $this->addAccount();
        $this->addTags();
        $this->addCategory();
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

    private function filterTags()
    {
        if( !empty( $this->tags ) ){
            $this->query->whereHas('tags', function( $query ){
                $query->whereIn('id', $this->tags );
            });
        }
    }

    private function filterCategory()
    {
        if( $this->category != 'all' ){
            $this->query->where('category_id', '=', $this->category);
        }
    }

    private function filterDirection()
    {
        if( $this->direction != 'all' ){
            $this->query->where('direction', '=', $this->direction );
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

    private function addCategory()
    {
        $this->query->with('category');
    }

    private function addSplits()
    {
        $this->query->with(['splits' => function( $query ){
            $query->with('category');
        }]);
    }

    private function orderBy()
    {
        $this->query->orderBy($this->orderBy, $this->orderDirection);
    }

    private function syncData( $data )
    {
        if( isset( $data['account'] ) && isset( $data['account_type'] ) ){
            $this->loadAccount( $data['account'], $data['account_type'] );
        }

        $this->direction = isset( $data['direction'] )
                            ? $data['direction']
                            : 'all';

        $this->tags = isset( $data['tags'] )
                        ? explode(',', $data['tags'])
                        : [];

        $this->category = isset( $data['category'] )
                            ? $data['category']
                            : 'all';

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

    private function loadAccount( $id, $type )
    {
        switch( $type ){
            case 'cash':
                $this->account = CashAccount::where('id', '=', $id)->first();
            break;
            case 'loan':
                $this->account = Loan::where('id', '=', $id)->first();
            break;
            case 'checking':
                $this->account = CheckingAccount::where('id', '=', $id)->first();
            break;
            case 'savings':
                $this->account = SavingsAccount::where('id', '=', $id)->first();
            break;
            case 'credit-card':
                $this->account = CreditCard::where('id', '=', $id)->first();
            break;
        }
    }
}