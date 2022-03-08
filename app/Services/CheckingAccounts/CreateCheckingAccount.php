<?php

namespace App\Services\CheckingAccounts;

use App\Models\Accounts\CheckingAccount;

class CreateCheckingAccount
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
        $checkingAccount = new CheckingAccount();

        $checkingAccount->user_id = $this->user->id;
        $checkingAccount->name = $this->data['name'];
        $checkingAccount->number = $this->data['number'];
        $checkingAccount->institution_id = $this->data['institution'];
        $checkingAccount->description = $this->data['description'];
        $checkingAccount->current_balance = $this->data['current_balance'];

        $checkingAccount->save();

        return $checkingAccount;
    }
}
