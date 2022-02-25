<?php

namespace App\Policies;

use App\Models\Accounts\GiftCard;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GiftCardPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determines if the user can view the gift card
     */
    public function show( User $user, GiftCard $giftCard )
    {
        if( $user->id == $giftCard->user_id ){
            return true;
        }else{
            return false;
        }
    }

    public function update( User $user, GiftCard $giftCard )
    {
        if( $user->id == $giftCard->user_id ){
            return true;
        }else{
            return false;
        }
    }
}