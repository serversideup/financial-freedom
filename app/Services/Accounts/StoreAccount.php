<?php

namespace App\Services\Accounts;

use App\Models\Accounts\CashAccount;
use App\Models\Accounts\CheckingAccount;
use App\Models\Accounts\Loan;
use App\Models\Accounts\CreditCard;
use App\Models\Accounts\GiftCard;
use App\Models\Accounts\SavingsAccount;
use Illuminate\Support\Facades\Crypt;

class StoreAccount
{
    private $user;
    private $type;
    private $name;
    private $number;
    private $institutionID;
    private $description;
    private $openDate;
    private $paymentAmount;
    private $initialBalance;
    private $interestRate;
    private $company;
    private $location;
    private $expiration;
    private $url;
    private $code;

    public function __construct( $user, $data )
    {
        $this->user = $user;
        $this->hydrateLocal( $data );
    }

    public function store()
    {
        switch( $this->type ){
            case 'cash':
                $this->storeCashAccount();
            break;
            case 'checking-account':
                $this->storeCheckingAccount();
            break;
            case 'savings-account':
                $this->storeSavingsAccount();
            break;
            case 'loan':
                $this->storeLoan();
            break;
            case 'credit-card':
                $this->storeCreditCard();
            break;
            case 'gift-card':
                $this->storeGiftCard();
            break;
        }
    }

    private function storeCashAccount()
    {
        $cashAccount = new CashAccount();

        $cashAccount->user_id = $this->user->id;
        $cashAccount->name = $this->name;
        $cashAccount->description = $this->description;
        $cashAccount->current_balance = $this->initialBalance;

        $cashAccount->save();
    }

    private function storeLoan()
    {
        $loan = new Loan();

        $loan->user_id = $this->user->id;
        $loan->name = $this->name;
        $loan->number = $this->number;
        $loan->institution_id = $this->institutionID;
        $loan->description = $this->description;
        $loan->open_date = $this->openDate;
        $loan->interest_rate = $this->interestRate;
        $loan->payment_amount = $this->paymentAmount;
        $loan->current_balance = $this->initialBalance;

        $loan->save();
    }

    private function storeCreditCard()
    {
        $creditCard = new CreditCard();

        $creditCard->user_id = $this->user->id;
        $creditCard->name = $this->name;
        $creditCard->number = $this->number;
        $creditCard->institution_id = $this->institutionID;
        $creditCard->description = $this->description;
        $creditCard->interest_rate = $this->interestRate;
        $creditCard->current_balance = $this->initialBalance;

        $creditCard->save();
    }

    private function storeCheckingAccount()
    {
        $checkingAccount = new CheckingAccount();

        $checkingAccount->user_id = $this->user->id;
        $checkingAccount->name = $this->name;
        $checkingAccount->number = $this->number;
        $checkingAccount->institution_id = $this->institutionID;
        $checkingAccount->description = $this->description;
        $checkingAccount->current_balance = $this->initialBalance;

        $checkingAccount->save();
    }

    private function storeSavingsAccount()
    {
        $savingsAccount = new SavingsAccount();

        $savingsAccount->user_id = $this->user->id;
        $savingsAccount->name = $this->name;
        $savingsAccount->number = $this->number;
        $savingsAccount->institution_id = $this->institutionID;
        $savingsAccount->description = $this->description;
        $savingsAccount->current_balance = $this->initialBalance;

        $savingsAccount->save();
    }

    private function storeGiftCard()
    {
        $giftCard = new GiftCard();

        $giftCard->user_id = $this->user->id;
        $giftCard->company = $this->company;
        $giftCard->balance = $this->initialBalance;
        $giftCard->location = $this->location;
        $giftCard->expiration = $this->expiration;
        $giftCard->url = $this->url;
        $giftCard->code = Crypt::encryptString( $this->code );

        $giftCard->save();

    }

    private function hydrateLocal( $data )
    {
        $this->name = $data['name'];
        $this->type = $data['type'];
        $this->number = $data['number'];       
        $this->institutionID = $data['institution'];
        $this->description = $data['description'];
        $this->openDate = $data['open_date'] != '' ? date( 'Y-m-d', strtotime( $data['open_date'] ) ) : '';
        $this->paymentAmount = $data['payment_amount'];
        $this->initialBalance = $data['initial_balance'];
        $this->interestRate = $data['interest_rate'];
        $this->company = $data['company'];
        $this->location = $data['location'];
        $this->expiration = $data['expiration'];
        $this->url = $data['url'];
        $this->code = $data['code'];
    }
}