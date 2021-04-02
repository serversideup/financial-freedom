<?php

namespace App\Services\Accounts;

use App\Models\Accounts\Account;

class ShowAccount
{
    private $user;
    private $accountID;

    public function __construct( $user, $accountID )
    {
        $this->user = $user;
        $this->accountID = $accountID;
    }

    public function show()
    {
        $account = Account::where('id', '=', $this->accountID)
                            ->with('institution')
                            ->with('type')
                            ->first();

        return $account;
    }
}