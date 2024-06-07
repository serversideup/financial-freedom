<?php

namespace Modules\Transaction\Services;

use App\Models\CashAccount;
use App\Models\CreditCard;
use App\Models\Loan;
use Modules\Transaction\Http\Requests\StoreTransactionRequest;
use Modules\Transaction\Models\Transaction;
use Illuminate\Support\Str;

class StoreTransaction
{
    private $account;

    public function execute( StoreTransactionRequest $request )
    {
        $this->findAccount( $request );
        $this->createTransaction( $request );        
    }

    private function findAccount( $request )
    {
        switch( $request->input('account.type') ){
            case 'cash-account':
                $this->account = CashAccount::find( $request->input('account.id') );
            break;
            case 'credit-card':
                $this->account = CreditCard::find( $request->input('account.id') );
            break;
            case 'loan':
                $this->account = Loan::find( $request->input('account.id') );
            break;
        }
    }

    private function createTransaction( $request )
    {
        $transaction = Transaction::create([
            'uuid' => Str::uuid(),
            'user_id' => auth()->id(),
            'accountable_id' => $this->account->id,
            'accountable_type' => get_class( $this->account ),
            'category_id' => $request->input('category.id'),
            'amount' => $request->input('amount'),
            'date' => date( 'Y-m-d', strtotime( $request->input('date') ) ),
            'merchant' => $request->input('merchant'),
            'notes' => '',
            'type' => $request->input('direction'),
            'reconciled' => true
        ]);

        return $transaction;
    }
}