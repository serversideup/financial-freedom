<?php

namespace App\Services\CashAccounts;

use App\Models\Accounts\CashAccount;

class CreateCashAccount
{
    private $user;
    private $data;

    public function __construct( $user, $data )
    {
        $this->user = $user;
        $this->data = $data;    
    }

    public function create()
    {
        $cashAccount = new CashAccount();

        $cashAccount->user_id = $this->user->id;
        $cashAccount->name = $this->data['name'];
        $cashAccount->description = $this->data['description'];
        $cashAccount->current_balance = $this->data['initial_balance'];

        $cashAccount->save();

        return $cashAccount;
    }
}