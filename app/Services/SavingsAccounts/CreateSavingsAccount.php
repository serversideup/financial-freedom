<?php

namespace App\Services\SavingsAccounts;

use App\Models\Accounts\SavingsAccount;

class CreateSavingsAccount
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
        $savingsAccount = new SavingsAccount();

        $savingsAccount->user_id = $this->user->id;
        $savingsAccount->name = $this->data['name'];
        $savingsAccount->number = $this->data['number'];
        $savingsAccount->institution_id = $this->data['institution'];
        $savingsAccount->description = $this->data['description'];
        $savingsAccount->current_balance = $this->data['current_balance'];

        $savingsAccount->save();

        return $savingsAccount;
    }
}