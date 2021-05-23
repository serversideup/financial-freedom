<?php

namespace App\Policies;

use App\Models\Accounts\CheckingAccount;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CheckingAccountPolicy
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
    public function show( User $user, CheckingAccount $checkingAccount )
    {
        if( $user->id == $checkingAccount->user_id ){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determines if the user can update the account
     */
    public function update( User $user, CheckingAccount $checkingAccount )
    {
        if( $user->id == $checkingAccount->user_id ){
            return true;
        }else{
            return false;
        }
    }
}