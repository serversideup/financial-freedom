<?php

namespace App\Services\Allocations;

use App\Models\Accounts\CashAccount;
use App\Models\Accounts\CheckingAccount;
use App\Models\Accounts\SavingsAccount;
use App\Models\Allocations\Allocation;

class StoreAllocation
{
    private $user;
    private $name;
    private $account;
    private $description;
    private $amount;
    private $colors = ['#f05252', '#0e9f6e', '#3f83f8', '#9061f9', '#e74694', '#ff5a1f'];
   

    /**
     * @todo If the account is null, we need to have verified that
     * the data contains an account_type & account_id
     */
    public function __construct( $user, $data, $account = null )
    {
        $this->syncLocal( $user, $data, $account );
    }

    public function store()
    {
        $allocation = new Allocation();
        
        $allocation->user_id = $this->user->id;
        $allocation->accountable_id = $this->account->id;
        $allocation->accountable_type = get_class( $this->account );
        $allocation->name = $this->name;
        $allocation->color = $this->colors[ rand( 0, 5 ) ];
        $allocation->description = $this->description;
        $allocation->amount = $this->amount;

        $allocation->save();

        return $allocation;
    }

    private function syncLocal( $user, $data, $account )
    {
        $this->user = $user;
        $this->name = $data['name'];
        $this->description = $data['description'];
        $this->amount = $data['amount'];

        if( !$account ){
            $this->account = $this->loadAccount( $data['account_id'], $data['account_type'] );
        }else{
            $this->account = $account;
        }
    }

    private function loadAccount( $id, $type )
    {
        switch( $type ){
            case 'checking':
                return CheckingAccount::where('id', '=', $id)->first();
            break;
            case 'savings':
                return SavingsAccount::where('id', '=', $id)->first();
            break;
            case 'cash':
                return CashAccount::where('id', '=', $id)->first();
            break;
        }
    }
}