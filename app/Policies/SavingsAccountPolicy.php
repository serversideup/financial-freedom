<?php

namespace App\Policies;

use App\Models\Accounts\SavingsAccount;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SavingsAccountPolicy
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
    public function show( User $user, SavingsAccount $savingsAccount )
    {
        if( $user->id == $savingsAccount->user_id ){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determines if the user can update the account
     */
    public function update( User $user, SavingsAccount $savingsAccount )
    {
        if( $user->id == $savingsAccount->user_id ){
            return true;
        }else{
            return false;
        }
    }
}
