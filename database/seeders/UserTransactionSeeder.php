<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transactions\Transaction;
use App\Models\Accounts\CheckingAccount;
use Carbon\Carbon;

class UserTransactionSeeder extends Seeder
{   
    /**
     * ID of the demo account user
     */
    private $userID = 3;

    /**
     * ID of the account we will apply the transactions to
     */
    private $accountID = 3;

    /**
     * Month to generate transactions for
     */
    private $month = '09';

    /**
     * Year to generate transactions for
     */
    private $year = '2021';

    /**
     * Type of account we will apply the transactions to
     */
    private $accountType = 'checking';

    /**
     * Account we are applying the transactions to
     */
    private $account;

    /**
     * Income category settings
     */
    private $categoryIncome = [
        "id" => 1,
        "names" => [
            "Work Pay Check" => [
                0 => "Monthly income"
            ],
            "Venmo" => [
                0 => "Re-imbursement for tacos",
            ],
            "Yard Sale" => [
                0 => "Sale of old items"
            ]
        ],
        "maxTransactions" => 3,
        "minAmount" => 200.00,
        "maxAmount" => 5000.00
    ];

    /**
     * Housing category settings
     */
    private $categoryHousing = [
        "id" => 2,
        "names" => [
            "Mortgage Payment" => [
                0 => 'Monthly mortgage payment'
            ],
            "Monthly Rent Payment" => [
                0 => 'Rent payment for the month'
            ]
        ],
        "maxTransactions" => 1,
        "minAmount" => 600.00,
        "maxAmount" => 3785.00
    ];

    /**
     * Transportation category settings
     */
    private $categoryTransportation = [
        "id" => 7,
        "names" => [
            "Citgo" => [
                0 => 'Truck fill up for vacation',
                1 => 'Car fill up for commute'
            ],
            "BP" => [
                0 => 'Truck fill up for vacation',
                1 => 'Car fill up for commute'
            ],
            "Shell" => [
                0 => 'Truck fill up for vacation',
                1 => 'Car fill up for commute'
            ],
            "Midas Oil Change" => [
                0 => 'Oil change on the car',
                1 => 'Oil change on the truck',
                2 => 'Motorcycle oil change'
            ],
            "Ford Dealership" => [
                0 => 'Standard maintenance procedure'
            ]
        ],
        "maxTransactions" => 6,
        "minAmount" => 20.00,
        "maxAmount" => 100.00
    ];

    /**
     * Dining out category settings
     */
    private $categoryDiningOut = [
        "id" => 199,
        "names" => [
            "Five Guys" => [
                0 => 'Lunch'
            ],
            "La Sirena Grill" => [
                0 => 'Dinner'
            ],
            "Driftless Cafe" => [
                0 => 'Dinner'
            ],
            "Maple Block" => [
                0 => 'Lunch before concert'
            ],
            "Super Tacos Moy" => [
                0 => 'Lunch'
            ]
        ],
        "maxTransactions" => 8,
        "minAmount" => 10.00,
        "maxAmount" => 100.00
    ];

    /**
     * Grocery category settings
     */
    private $categoryGroceries = [
        "id" => 63,
        "names" => [
            "Whole Foods Market" => [
                0 => 'Weekly Groceries',
                1 => 'Snacks'
            ],
            "Kroger" => [
                0 => 'Weekly Groceries',
                1 => 'Snacks'
            ],
            "Pick n Save" => [
                0 => 'Weekly Groceries',
                1 => 'Snacks'
            ],
            "Sendiks" => [
                0 => 'Weekly Groceries',
                1 => 'Snacks'
            ],
            "Aldi" => [
                0 => 'Weekly Groceries',
                1 => 'Snacks'
            ],
            "Trader Joes" => [
                0 => 'Weekly Groceries',
                1 => 'Snacks'
            ]
        ],
        "maxTransactions" => 10,
        "minAmount" => 10.00,
        "maxAmount" => 150.00
    ];

    /**
     * Entertainment category settings
     */
    private $categoryEntertainment = [
        "id" => 149,
        "names" => [
            "RHCP Concert" => [
                0 => "Concert in Chicago"
            ],
            "Black Keys Concert" => [
                0 => "Concert in Milwaukee",
            ],
            "Lord Huron Concert" => [
                0 => "Concert in Madison"
            ]
        ],
        "maxTransactions" => 1,
        "minAmount" => 100.00,
        "maxAmount" => 500.00
    ];

    /**
     * Savings category settings
     */
    private $categorySavings = [
        "id" => 189,
        "names" => [
            "Roth IRA Contribution" => [
                0 => "Monthly contribution to Roth IRA"
            ]
        ],
        "maxTransactions" => 1,
        "minAmount" => 500.00,
        "maxAmount" => 500.00
    ];


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->loadAccount();
        $this->generate();
    }

    private function loadAccount()
    {
        switch( $this->accountType ){
            case 'checking':
                $this->account = CheckingAccount::where('id', $this->accountID)->first();
            break;
        }
    }

    private function generate()
    {
        $this->generateIncomeTransactions();
        $this->generateHousingTransactions();
        $this->generateTransportationTransactions();
        $this->generateDiningOutTransactions();
        $this->generateGroceryTransactions();
        $this->generateEntertainmentTransactions();
        $this->generateSavingsTransactions();
    }

    private function generateIncomeTransactions()
    {
        for( $i = 0; $i < $this->categoryIncome['maxTransactions']; $i++ ){
            $transaction = new Transaction();

            $transaction->unique_id = uniqid();
            $transaction->user_id = $this->userID;
            $transaction->accountable_id = $this->account->id;
            $transaction->accountable_type = get_class( $this->account );
            $transaction->category_id = $this->categoryIncome['id'];
            $transaction->amount = $this->generateAmount( $this->categoryIncome );
            $transaction->date = $this->generateDate();
            
            $meta = $this->randomMeta( $this->categoryIncome );

            $transaction->name = $meta['name'];
            $transaction->description = $meta['description'];
            $transaction->direction = 'inflow';
            $transaction->reconciled = 0;

            $transaction->save();
        }
    }

    private function generateHousingTransactions()
    {
        for( $i = 0; $i < $this->categoryHousing['maxTransactions']; $i++ ){
            $transaction = new Transaction();

            $transaction->unique_id = uniqid();
            $transaction->user_id = $this->userID;
            $transaction->accountable_id = $this->account->id;
            $transaction->accountable_type = get_class( $this->account );
            $transaction->category_id = $this->categoryHousing['id'];
            $transaction->amount = $this->generateAmount( $this->categoryHousing );
            $transaction->date = $this->generateDate();
            
            $meta = $this->randomMeta( $this->categoryHousing );

            $transaction->name = $meta['name'];
            $transaction->description = $meta['description'];
            $transaction->direction = 'outflow';
            $transaction->reconciled = 0;

            $transaction->save();
        }
    }

    private function generateTransportationTransactions()
    {
        for( $i = 0; $i < $this->categoryTransportation['maxTransactions']; $i++ ){
            $transaction = new Transaction();

            $transaction->unique_id = uniqid();
            $transaction->user_id = $this->userID;
            $transaction->accountable_id = $this->account->id;
            $transaction->accountable_type = get_class( $this->account );
            $transaction->category_id = $this->categoryTransportation['id'];
            $transaction->amount = $this->generateAmount( $this->categoryTransportation );
            $transaction->date = $this->generateDate();
            
            $meta = $this->randomMeta( $this->categoryTransportation );

            $transaction->name = $meta['name'];
            $transaction->description = $meta['description'];
            $transaction->direction = 'outflow';
            $transaction->reconciled = 0;

            $transaction->save();
        }
    }

    private function generateDiningOutTransactions()
    {
        for( $i = 0; $i < $this->categoryDiningOut['maxTransactions']; $i++ ){
            $transaction = new Transaction();

            $transaction->unique_id = uniqid();
            $transaction->user_id = $this->userID;
            $transaction->accountable_id = $this->account->id;
            $transaction->accountable_type = get_class( $this->account );
            $transaction->category_id = $this->categoryDiningOut['id'];
            $transaction->amount = $this->generateAmount( $this->categoryDiningOut );
            $transaction->date = $this->generateDate();
            
            $meta = $this->randomMeta( $this->categoryDiningOut );

            $transaction->name = $meta['name'];
            $transaction->description = $meta['description'];
            $transaction->direction = 'outflow';
            $transaction->reconciled = 0;

            $transaction->save();
        }
    }

    private function generateGroceryTransactions()
    {
        for( $i = 0; $i < $this->categoryGroceries['maxTransactions']; $i++ ){
            $transaction = new Transaction();

            $transaction->unique_id = uniqid();
            $transaction->user_id = $this->userID;
            $transaction->accountable_id = $this->account->id;
            $transaction->accountable_type = get_class( $this->account );
            $transaction->category_id = $this->categoryGroceries['id'];
            $transaction->amount = $this->generateAmount( $this->categoryGroceries );
            $transaction->date = $this->generateDate();
            
            $meta = $this->randomMeta( $this->categoryGroceries );

            $transaction->name = $meta['name'];
            $transaction->description = $meta['description'];
            $transaction->direction = 'outflow';
            $transaction->reconciled = 0;

            $transaction->save();
        }
    }

    private function generateEntertainmentTransactions()
    {
        for( $i = 0; $i < $this->categoryEntertainment['maxTransactions']; $i++ ){
            $transaction = new Transaction();

            $transaction->unique_id = uniqid();
            $transaction->user_id = $this->userID;
            $transaction->accountable_id = $this->account->id;
            $transaction->accountable_type = get_class( $this->account );
            $transaction->category_id = $this->categoryEntertainment['id'];
            $transaction->amount = $this->generateAmount( $this->categoryEntertainment );
            $transaction->date = $this->generateDate();
            
            $meta = $this->randomMeta( $this->categoryEntertainment );

            $transaction->name = $meta['name'];
            $transaction->description = $meta['description'];
            $transaction->direction = 'outflow';
            $transaction->reconciled = 0;

            $transaction->save();
        }
    }

    private function generateSavingsTransactions()
    {
        for( $i = 0; $i < $this->categorySavings['maxTransactions']; $i++ ){
            $transaction = new Transaction();

            $transaction->unique_id = uniqid();
            $transaction->user_id = $this->userID;
            $transaction->accountable_id = $this->account->id;
            $transaction->accountable_type = get_class( $this->account );
            $transaction->category_id = $this->categorySavings['id'];
            $transaction->amount = $this->generateAmount( $this->categorySavings );
            $transaction->date = $this->generateDate();
            
            $meta = $this->randomMeta( $this->categorySavings );

            $transaction->name = $meta['name'];
            $transaction->description = $meta['description'];
            $transaction->direction = 'outflow';
            $transaction->reconciled = 0;

            $transaction->save();
        }
    }

    private function generateAmount( $category )
    {
        return number_format( 
            ( mt_rand( $category['minAmount'] * 10, $category['maxAmount'] * 10 ) / 10 ),
            2,
            '.',
            ''
        );
    }

    private function generateDate()
    {
        $date = Carbon::createFromFormat('Y-m-d', $this->year.'-'.$this->month.'-01');
        
        $min = 1;
        $max = $date->daysInMonth;
   
        return $this->year.'-'.$this->month.'-'.str_pad( rand($min, $max), 2, '0', STR_PAD_LEFT );
    }

    private function randomMeta( $category )
    {
        $name = array_rand( $category['names'] );
        $description = $category['names'][$name][ array_rand( $category['names'][$name] )];

        return [
            "name" => $name,
            "description" => $description
        ];
    }
}
