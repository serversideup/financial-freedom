<?php

namespace App\Policies;

use App\Models\Accounts\CreditCard;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CreditCardPolicy
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
     * Determines if the user can view the account
     */
    public function show( User $user, CreditCard $creditCard )
    {
        if( $user->id == $creditCard->user_id ){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determines if the user can update the account
     */
    public function update( User $user, CreditCard $creditCard )
    {
        if( $user->id == $creditCard->user_id ){
            return true;
        }else{
            return false;
        }
    }
}