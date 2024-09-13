<?php

namespace Modules\Transaction\Services;

use App\Models\CashAccount;
use App\Models\CreditCard;
use App\Models\Loan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Modules\Transaction\Models\Transaction;

class IndexTransactions
{
    protected $request;
    private $query;

    public function execute( Request $request, $paginate = true )
    {
        $this->request = $request;
        $this->query = Transaction::query();

        $this->applySearch();
        $this->filterAccount();
        $this->filterCategory();
        $this->filterDates();

        $this->query->with( 'category' );
        $this->query->with( 'category.group' );
        
        $this->query->orderBy( 'date', 'desc' );

        return $paginate ? $this->query->paginate() : $this->query->get();
    }

    private function applySearch()
    {
        if ( $this->request->has( 'search' ) ) {
            $this->query->where( function( $query ){
                $query->where( 'merchant', 'like', '%' . $this->request->input( 'search' ) . '%' )
                    ->orWhere( 'notes', 'like', '%' . $this->request->input( 'search' ) . '%' );
            } );
        }
    }

    private function filterAccount()
    {
        if ( $this->request->has( 'account_id' ) && $this->request->has( 'account_type' ) ) {
            $account = null;

            switch( $this->request->input( 'account_type' ) ) {
                case 'cash-account':
                    $account = CashAccount::find( $this->request->input( 'account_id' ) );
                break;
                case 'credit-card':
                    $account = CreditCard::find( $this->request->input( 'account_id' ) );
                break;
                case 'loan':
                    $account = Loan::find( $this->request->input( 'account_id' ) );
                break;
            }

            if( $account ) {
                $this->query->whereHasMorph(
                    'accountable',
                    [get_class( $account ), Transaction::class],
                    function( Builder $query ) use ( $account ) {
                        $query->where( 'accountable_id', $account->id );
                    }
                );
            }
        }
    }

    private function filterCategory()
    {
        if ( $this->request->has( 'category_id' ) ) {
            $this->query->where( 'category_id', $this->request->input( 'category_id' ) );
        }
    }


    private function filterDates()
    {
        if ( $this->request->has( 'start_date' ) ) {
            $startDate = date( 'Y-m-d', strtotime( $this->request->input( 'start_date' ) ) );
            $this->query->where( 'date', '>=', $startDate );
        }

        if ( $this->request->has( 'end_date' ) ) {
            $endDate = date( 'Y-m-d', strtotime( $this->request->input( 'end_date' ) ) );
            $this->query->where( 'date', '<=', $endDate );
        }
    }
}