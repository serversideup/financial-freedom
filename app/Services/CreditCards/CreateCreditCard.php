<?php

namespace App\Services\CreditCards;

use App\Models\Accounts\CreditCard;

class CreateCreditCard
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
        $creditCard = new CreditCard();

        $creditCard->user_id = $this->user->id;
        $creditCard->name = $this->data['name'];
        $creditCard->number = $this->data['number'];
        $creditCard->institution_id = $this->data['institution'];
        $creditCard->description = $this->data['description'];
        $creditCard->interest_rate = $this->data['interest_rate'];
        $creditCard->current_balance = $this->data['current_balance'];

        $creditCard->save();
    }
}