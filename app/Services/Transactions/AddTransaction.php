<?php

namespace App\Services\Transactions;

use App\Models\Transactions\Transaction;
use App\Models\Accounts\CheckingAccount;
use App\Models\Accounts\CreditCard;
use App\Services\Tags\GetTag;

class AddTransaction
{
    private $user;
    private $account;
    private $amount;
    private $direction;
    private $name;
    private $date;
    private $description;

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
        $transaction->amount = $this->amount;
        $transaction->date = $this->date;
        $transaction->name = $this->name;
        $transaction->description = $this->description;
        $transaction->direction = $this->direction;
        $transaction->reconciled = 0;

        $transaction->save();

        $this->tagTransaction( $transaction );

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
        $this->description = $data['description'];
        $this->tags = isset( $data['tags'] ) ? json_decode( $data['tags'] ) : null;
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
}