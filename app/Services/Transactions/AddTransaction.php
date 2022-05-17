<?php

namespace App\Services\Transactions;

use App\Models\Transactions\Transaction;
use App\Models\Accounts\CheckingAccount;
use App\Models\Accounts\CreditCard;
use App\Models\Accounts\SavingsAccount;
use App\Services\BudgetsPeriods\ApplyTransaction;
use App\Services\Tags\GetTag;

class AddTransaction
{
    private $user;
    private $account;
    private $category;
    private $amount;
    private $direction;
    private $name;
    private $date;
    private $description;
    private $updateBalance;

    public function __construct( $user, $data )
    {
        $this->user = $user;
        $this->syncLocal( $data );
    }

    public function store()
    {
        $transaction = new Transaction();

        /**
         * @todo Change for the actual account ID when
         * implementing Plaid
         */
        $transaction->unique_id = uniqid();
        $transaction->user_id = $this->user->id;
        $transaction->accountable_id = $this->account->id;
        $transaction->accountable_type = get_class( $this->account );
        $transaction->category_id = $this->category['id'];
        $transaction->amount = $this->amount;
        $transaction->date = $this->date;
        $transaction->name = $this->name;
        $transaction->description = $this->description;
        $transaction->direction = $this->direction;
        $transaction->reconciled = 0;

        $transaction->save();

        $this->tagTransaction( $transaction );
        $this->updateAccountBalance();
        $this->applyToCurrentBudgetPeriod( $transaction );

        return $transaction;
    }

    private function tagTransaction( $transaction )
    {
        if( $this->tags ){
            $syncTags = [];

            foreach( $this->tags as $submittedTag ){
                $getTag = new GetTag( $submittedTag->name, $this->user );
                $tag = $getTag->get();

                array_push( $syncTags, $tag->id );
            }

            $transaction->tags()->sync( $syncTags );
        }
    }

    private function syncLocal( $data )
    {
        $this->loadAccount( $data['account'] );
        $this->amount = number_format( $data['amount'], 2, '.', '' );
        $this->direction = $data['direction'];
        $this->name = $data['name'];
        $this->date = date( 'Y-m-d', strtotime( $data['date'] ) );
        $this->description = isset( $data['description'] ) ? $data['description'] : '';
        $this->category = $data['category'];

        if( isset( $data['tags'] ) ){
            $this->tags = is_array( $data['tags'] ) ? json_decode( json_encode( $data['tags'] ) ) : json_decode( $data['tags'] );
        }else{
            $this->tags = null;
        }

        $this->updateBalance = isset( $data['update_balance'] ) ? $data['update_balance'] : 'no';
    }

    private function loadAccount( $account )
    {
        switch( $account['account_type'] ){
            case 'checking':
                $this->loadCheckingAccount( $account['id'] );
            break;
            case 'credit-card':
                $this->loadCreditCardAccount( $account['id'] );
            break;
            case 'savings':
                $this->loadSavingsAccount( $account['id'] );
            break;
        }
    }

    private function loadCheckingAccount( $id )
    {
        $this->account = CheckingAccount::where('id', '=', $id)->first();
    }

    private function loadCreditCardAccount( $id )
    {
        $this->account = CreditCard::where('id', '=', $id)->first();
    }

    private function loadSavingsAccount( $id )
    {
        $this->account = SavingsAccount::where('id', '=', $id)->first();
    }

    private function updateAccountBalance()
    {
        if( $this->updateBalance ){
            if( $this->direction == 'outflow' ){
                $this->account->current_balance = $this->account->current_balance - $this->amount;
            }else{
                $this->account->current_balance = $this->account->current_balance + $this->amount;
            }

            $this->account->save();
        }
    }

    private function applyToCurrentBudgetPeriod( $transaction )
    {
        ( new ApplyTransaction( $transaction ) )->apply();
    }
    
}