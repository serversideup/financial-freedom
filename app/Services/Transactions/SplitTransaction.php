<?php

namespace App\Services\Transactions;

use App\Models\Transactions\Transaction;
use App\Models\Transactions\Split;
use App\Services\Tags\GetTag;
use Auth;

class SplitTransaction
{
    private $transaction;
    private $amount;
    private $name;
    private $description;
    private $split;
    private $tags;

    public function __construct( $data, $transactionID )
    {
        $this->syncLocal( $data, $transactionID );
    }

    public function split()
    {
        $this->createSplit();
        $this->tagSplit();

        return $this->split;
    }

    private function createSplit()
    {
        $this->split = new Split();

        $this->split->transaction_id = $this->transaction->id;
        $this->split->amount = $this->amount;
        $this->split->name = $this->name;
        $this->split->description = $this->description;

        $this->split->save();
    }

    private function tagSplit()
    {
        if( $this->tags ){
            $syncTags = [];

            foreach( $this->tags as $submittedTag ){
                $getTag = new GetTag( $submittedTag->name, Auth::user() );
                $tag = $getTag->get();

                array_push( $syncTags, $tag->id );
            }

            $this->split->tags()->sync( $syncTags );
        }
    }

    private function syncLocal( $data, $transactionID )
    {
        $this->transaction = Transaction::where('id', '=', $transactionID)->first();

        $this->amount = number_format( $data['amount'], 2, '.', '' );
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->tags = isset( $data['tags'] ) ? json_decode( $data['tags'] ) : null;
    }
}