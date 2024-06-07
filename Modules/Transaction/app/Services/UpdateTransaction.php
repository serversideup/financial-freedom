<?php

namespace Modules\Transaction\Services;

use App\Models\CashAccount;
use App\Models\CreditCard;
use App\Models\Loan;
use Modules\Transaction\Http\Requests\UpdateTransactionRequest;
use Modules\Transaction\Models\Transaction;

class UpdateTransaction
{
    private $account;
    private $transaction;

    public function execute( UpdateTransactionRequest $request, Transaction $transaction )
    {
        $this->transaction = $transaction;
        $this->findAccount( $request );
        $this->updateTransaction( $request );
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

    private function updateTransaction( $request )
    {
        $this->transaction->update([
            'accountable_id' => $this->account->id,
            'accountable_type' => get_class( $this->account ),
            'category_id' => $request->input('category.id'),
            'amount' => $request->input('amount'),
            'date' => date( 'Y-m-d', strtotime( $request->input('date') ) ),
            'merchant' => $request->input('merchant'),
            'type' => $request->input('direction'),
        ]);
    }
}