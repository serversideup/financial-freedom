<?php

namespace App\Policies;

use App\Models\Accounts\Loan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LoanPolicy
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
    public function show( User $user, Loan $loan )
    {
        if( $user->id == $loan->user_id ){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determines if the user can update the account
     */
    public function update( User $user, Loan $loan )
    {
        if( $user->id == $loan->user_id ){
            return true;
        }else{
            return false;
        }
    }
}