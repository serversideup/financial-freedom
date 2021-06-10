<?php

namespace App\Policies;

use App\Models\Accounts\CashAccount;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CashAccountPolicy
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
    public function show( User $user, CashAccount $cashAccount )
    {
        if( $user->id == $cashAccount->user_id ){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determines if the user can update the account
     */
    public function update( User $user, CashAccount $cashAccount )
    {
        if( $user->id == $cashAccount->user_id ){
            return true;
        }else{
            return false;
        }
    }
}