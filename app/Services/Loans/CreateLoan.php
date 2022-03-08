<?php

namespace App\Services\Loans;

use App\Models\Accounts\Loan;

class CreateLoan
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
        $loan = new Loan();

        $loan->user_id = $this->user->id;
        $loan->name = $this->data['name'];
        $loan->number = $this->data['number'];
        $loan->institution_id = $this->data['institution'];
        $loan->description = $this->data['description'];
        $loan->open_date = $this->data['open_date'];
        $loan->interest_rate = $this->data['interest_rate'];
        $loan->payment_amount = $this->data['payment_amount'];
        $loan->current_balance = $this->data['current_balance'];

        $loan->save();

        return $loan;
    }
}
