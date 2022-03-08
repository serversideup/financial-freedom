<?php

namespace App\Services\GiftCards;

use App\Models\Accounts\GiftCard;
use Illuminate\Support\Facades\Crypt;

class CreateGiftCard
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
        $giftCard = new GiftCard();

        $giftCard->user_id = $this->user->id;
        $giftCard->company = $this->data['company'];
        $giftCard->balance = $this->data['balance'];
        $giftCard->location = $this->data['location'];
        $giftCard->expiration = $this->data['expiration'];
        $giftCard->url = $this->data['url'];
        $giftCard->code = Crypt::encryptString( $this->data['code'] );

        $giftCard->save();

        return $giftCard;
    }
}