<?php

namespace App\Services\Transactions;

use App\Models\Transactions\Transaction;
use App\Services\Tags\GetTag;
use Storage;
use Auth;

class UpdateTransaction
{
    private $transaction;
    private $receipt;
    private $tags;
    
    public function __construct( $transactionID, $data )
    {
        $this->syncLocal( $transactionID, $data );
    }

    public function update()
    {
        if( $this->receipt ){
            $this->transaction->receipt_url = $this->uploadReceipt();
        }
        $this->tagTransaction();

        $this->transaction->save();
    }

    private function uploadReceipt()
    {
        $path = Storage::put( '/private/transactions/'.$this->transaction->id, $this->receipt );
        return $path;
    }

    private function tagTransaction()
    {
        if( $this->tags ){
            $syncTags = [];

            foreach( $this->tags as $submittedTag ){
                $getTag = new GetTag( $submittedTag->name, Auth::user() );
                $tag = $getTag->get();

                array_push( $syncTags, $tag->id );
            }

            $this->transaction->tags()->sync( $syncTags );
        }
    }

    private function syncLocal( $transactionID, $data )
    {
        $this->transaction = Transaction::where('id', '=', $transactionID)->first();
        $this->receipt = isset( $data['receipt'] ) ? $data['receipt'] : '';
        $this->tags = isset( $data['tags'] ) ? json_decode( $data['tags'] ) : null;
    }
}