<?php

namespace Modules\Initialize\Actions;

use App\Models\CashAccount;
use Modules\Category\Models\Category;
use App\Models\CreditCard;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Modules\Transaction\Models\Transaction;

class CreateTransactions
{
    protected $merchants;

    public function __construct(
        protected User $user,
    ){}

    public function handle()
    {
        $this->loadMerchants();
        $this->createTransactions();
    }

    private function loadMerchants()
    {
        $this->merchants = File::json( module_path('Initialize', 'app/Data/merchants.json') );
    }

    private function createTransactions()
    {
        $this->createTransactionsForCashAccounts();
        $this->createTransactionsForCreditCards();
    }

    private function createTransactionsForCashAccounts()
    {
        $accounts = CashAccount::where('user_id', $this->user->id)->get();

        foreach( $accounts as $account ) {
            $transactions = $this->generateTransactions(10);
            $this->persistTransactions( $account, $transactions );
            
        }
    }

    private function createTransactionsForCreditCards()
    {
        $accounts = CreditCard::where('user_id', $this->user->id)->get();

        foreach( $accounts as $account ) {
            $transactions = $this->generateTransactions(10);
            $this->persistTransactions( $account, $transactions );
        }
    }

    private function generateTransactions( $count )
    {
        $transactions = [];

        for( $i = 0; $i < $count; $i++ ) {
            $merchant = $this->merchants[rand( 0, count( $this->merchants ) - 1 ) ];
            
            $categoryIndex = rand(0, count( $merchant['categories'] ) - 1);

            $category = Category::where('name', $merchant['categories'][$categoryIndex])->first();

            $transactions[] = [
                'amount' => rand($merchant["amount_range"]["min"], $merchant["amount_range"]["max"]),
                'merchant' => $merchant['name'],
                'date' => now()->subDays(rand(1, 60)),
                'category_id' => $category->id,
                'type' => 'debit'
            ];
        }

        return $transactions;
    }

    private function persistTransactions( $account, $transactions )
    {
        foreach( $transactions as $transaction ) {
            Transaction::create([
                'uuid' => Str::uuid(),
                'user_id' => $this->user->id,
                'accountable_id' => $account->id,
                'accountable_type' => get_class( $account ),
                'category_id' => $transaction['category_id'],
                'amount' => number_format( $transaction['amount'] / 100, 2, '.', '' ),
                'date' => date( 'Y-m-d', strtotime( $transaction['date'] ) ),
                'merchant' => $transaction['merchant'],
                'notes' => null,
                'type' => $transaction['type'],
                'reconciled' => true,
                'original' => null
            ]);
        }
    }
    
}