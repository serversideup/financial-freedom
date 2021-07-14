<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Included in version 0.1.1
 */
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->importPrimaryCategories();
        $this->importSecondaryCategories();
    }

    private function importPrimaryCategories()
    {
        DB::table('categories')->insert( [
                [
                    'id' => 1,
                    'parent_id' => null,
                    'name' => '💵 Income',
                    'color' => 'green'
                ],
                [
                    'id' => 2,
                    'parent_id' => null,
                    'name' => '🏡 Housing',
                    'color' => 'purple'
                ],
                [
                    'id' => 3,
                    'parent_id' => null,
                    'name' => '🧽 Home Services',
                    'color' => 'orange'
                ],
                [
                    'id' => 4,
                    'parent_id' => null,
                    'name' => '⚡️ Utilities',
                    'color' => 'gray'
                ],
                [
                    'id' => 5,
                    'parent_id' => null,
                    'name' => '🛠 Household Items',
                    'color' => 'gray'
                ],
                [
                    'id' => 6,
                    'parent_id' => null,
                    'name' => '🍏 Food',
                    'color' => 'blue'
                ],
                [
                    'id' => 7,
                    'parent_id' => null,
                    'name' => '🚌 Transportation',
                    'color' => 'pink'
                ],
                [
                    'id' => 8,
                    'parent_id' => null,
                    'name' => '👨‍⚕️ Medical/Health',
                    'color' => 'red'
                ],
                [
                    'id' => 9,
                    'parent_id' => null,
                    'name' => '📝 Insurance',
                    'color' => 'red'
                ],
                [
                    'id' => 10,
                    'parent_id' => null,
                    'name' => '👶 Kids',
                    'color' => 'blue'
                ],
                [
                    'id' => 11,
                    'parent_id' => null,
                    'name' => '🐶 Pets',
                    'color' => 'blue'
                ],
                [
                    'id' => 12,
                    'parent_id' => null,
                    'name' => '📺 Subscriptions/Streaming Services',
                    'color' => 'red'
                ],
                [
                    'id' => 13,
                    'parent_id' => null,
                    'name' => '💇‍♀️ Personal Care',
                    'color' => 'pink'
                ],
                [
                    'id' => 14,
                    'parent_id' => null,
                    'name' => '🙇‍♂️ Personal Development',
                    'color' => 'blue'
                ],
                [
                    'id' => 15,
                    'parent_id' => null,
                    'name' => '💸 Financial/Professional Feeds',
                    'color' => 'red'
                ],
                [
                    'id' => 16,
                    'parent_id' => null,
                    'name' => '🏈 Recreation/Fun',
                    'color' => 'green'
                ],
                [
                    'id' => 17,
                    'parent_id' => null,
                    'name' => '🗺 Travel',
                    'color' => 'purple'
                ],
                [
                    'id' => 18,
                    'parent_id' => null,
                    'name' => '📱 Technology',
                    'color' => 'blue'
                ],
                [
                    'id' => 19,
                    'parent_id' => null,
                    'name' => '🎁 Gifts',
                    'color' => 'red'
                ],
                [
                    'id' => 20,
                    'parent_id' => null,
                    'name' => '🤝 Charitable Giving',
                    'color' => 'pink'
                ],
                [
                    'id' => 21,
                    'parent_id' => null,
                    'name' => '💰 Savings Goals/Investing',
                    'color' => 'green'
                ],
                [
                    'id' => 22,
                    'parent_id' => null,
                    'name' => '🤑 Debt Payments',
                    'color' => 'red'
                ]
            ]
        );
    }

    private function importSecondaryCategories()
    {
        DB::table('categories')->insert( [
                [
                    'parent_id' => 1,
                    'name' => 'Salary & Wages',
                    'color' => 'green'
                ],
                [
                    'parent_id' => 1,
                    'name' => 'Self-employed Income',
                    'color' => 'green'
                ],
                [
                    'parent_id' => 1,
                    'name' => 'Bonus',
                    'color' => 'green'
                ],
                [
                    'parent_id' => 1,
                    'name' => 'Tips',
                    'color' => 'green'
                ],
                [
                    'parent_id' => 1,
                    'name' => 'Tax Refund',
                    'color' => 'green'
                ],
                [
                    'parent_id' => 1,
                    'name' => 'Gifts Received',
                    'color' => 'green'
                ],
                [
                    'parent_id' => 1,
                    'name' => 'Alimony Received',
                    'color' => 'green'
                ],
                [
                    'parent_id' => 1,
                    'name' => 'Child Support Received',
                    'color' => 'green'
                ],
                [
                    'parent_id' => 1,
                    'name' => 'Rental Income',
                    'color' => 'green'
                ],
                [
                    'parent_id' => 1,
                    'name' => 'Dividend Income',
                    'color' => 'green'
                ],
                [
                    'parent_id' => 1,
                    'name' => 'Interest Earned',
                    'color' => 'green'
                ],
                [
                    'parent_id' => 2,
                    'name' => 'Mortgage/Rent',
                    'color' => 'purple'
                ],
                [
                    'parent_id' => 2,
                    'name' => 'Homeowners association (HOA fees)',
                    'color' => 'purple'
                ],
                [
                    'parent_id' => 2,
                    'name' => 'Homeowners insurance / Renters insurance',
                    'color' => 'purple'
                ],
                [
                    'parent_id' => 2,
                    'name' => 'Property insurance (i.e. jewelry)',
                    'color' => 'purple'
                ],
                [
                    'parent_id' => 2,
                    'name' => 'Home repairs / Maintenance',
                    'color' => 'purple'
                ],
                [
                    'parent_id' => 2,
                    'name' => 'Property Taxes',
                    'color' => 'purple'
                ],
                [
                    'parent_id' => 2,
                    'name' => 'Home Improvement',
                    'color' => 'purple'
                ],
                [
                    'parent_id' => 2,
                    'name' => 'Furnishings',
                    'color' => 'purple'
                ],
                [
                    'parent_id' => 3,
                    'name' => 'House Cleaning',
                    'color' => 'orange'
                ],
                [
                    'parent_id' => 3,
                    'name' => 'Lawn Care',
                    'color' => 'orange'
                ],
                [
                    'parent_id' => 3,
                    'name' => 'Security System',
                    'color' => 'orange'
                ],
                [
                    'parent_id' => 3,
                    'name' => 'Pest Control',
                    'color' => 'orange'
                ],
                [
                    'parent_id' => 4,
                    'name' => 'Natural Gas / Electricity',
                    'color' => 'gray'
                ],
                [
                    'parent_id' => 4,
                    'name' => 'Landline / Home Phone',
                    'color' => 'gray'
                ],
                [
                    'parent_id' => 4,
                    'name' => 'Mobile Phone',
                    'color' => 'gray'
                ],
                [
                    'parent_id' => 4,
                    'name' => 'Home Internet',
                    'color' => 'gray'
                ],
                [
                    'parent_id' => 4,
                    'name' => 'Garbage',
                    'color' => 'gray'
                ],
                [
                    'parent_id' => 4,
                    'name' => 'Recycling',
                    'color' => 'gray'
                ],
                [
                    'parent_id' => 4,
                    'name' => 'Water',
                    'color' => 'gray'
                ],
                [
                    'parent_id' => 4,
                    'name' => 'Sewer',
                    'color' => 'gray'
                ],
                [
                    'parent_id' => 5,
                    'name' => 'Cleaning Supplies',
                    'color' => 'gray'
                ],
                [
                    'parent_id' => 5,
                    'name' => 'Paper Products',
                    'color' => 'gray'
                ],
                [
                    'parent_id' => 5,
                    'name' => 'Tools',
                    'color' => 'gray'
                ],
                [
                    'parent_id' => 5,
                    'name' => 'Toiletries',
                    'color' => 'gray'
                ],
                [
                    'parent_id' => 5,
                    'name' => 'Laundry Supplies',
                    'color' => 'gray'
                ],
                [
                    'parent_id' => 5,
                    'name' => 'Postage',
                    'color' => 'gray'
                ],
                [
                    'parent_id' => 5,
                    'name' => 'Furniture',
                    'color' => 'gray'
                ],
                [
                    'parent_id' => 5,
                    'name' => 'Home Decor',
                    'color' => 'gray'
                ],
                [
                    'parent_id' => 5,
                    'name' => 'Pool Supplies',
                    'color' => 'gray'
                ],
                [
                    'parent_id' => 6,
                    'name' => 'Groceries',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 6,
                    'name' => 'Fast Food',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 6,
                    'name' => 'Coffee Shops',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 6,
                    'name' => 'Breakfast',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 6,
                    'name' => 'Lunch',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 6,
                    'name' => 'Dinner',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 6,
                    'name' => 'Drinks',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 6,
                    'name' => 'Snacks',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 7,
                    'name' => 'Car Payment / Lease Payments',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 7,
                    'name' => 'Car Insurance',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 7,
                    'name' => 'Gas',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 7,
                    'name' => 'Oil Change',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 7,
                    'name' => 'Maintenance / Repairs',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 7,
                    'name' => 'Personal Property Taxes',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 7,
                    'name' => 'Registration',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 7,
                    'name' => 'Public Transportation',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 7,
                    'name' => 'Ride Sharing (Uber, Lyft)',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 7,
                    'name' => 'Tolls',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 7,
                    'name' => 'Parking Fees',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 7,
                    'name' => 'Roadside Assistance (AAA)',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 8,
                    'name' => 'Health Insurance',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 8,
                    'name' => 'Dental Insurance',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 8,
                    'name' => 'Vision Insurance',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 8,
                    'name' => 'Prescriptions / Medication',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 8,
                    'name' => 'Doctor Bills',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 8,
                    'name' => 'Dentist Visits',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 8,
                    'name' => 'Hospital Bills',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 8,
                    'name' => 'Optometrist',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 8,
                    'name' => 'Glasses, Contacts',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 8,
                    'name' => 'Chiropractor Visits',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 8,
                    'name' => 'Vitamins/Supplements',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 9,
                    'name' => 'Life Insurance',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 9,
                    'name' => 'Disability Insurance',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 9,
                    'name' => 'Long-term Care Insurance',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 9,
                    'name' => 'Umbrella Policy',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 9,
                    'name' => 'Identity Theft',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 10,
                    'name' => 'Tuition',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 10,
                    'name' => 'Daycare',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 10,
                    'name' => 'Babysitter / Nanny',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 10,
                    'name' => 'Diapers, Formula - Baby Necessities',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 10,
                    'name' => 'Summer Camp',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 10,
                    'name' => 'School or Extra-curricular activities',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 10,
                    'name' => 'School Supplies',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 10,
                    'name' => 'School Lunches',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 10,
                    'name' => 'Lessons',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 10,
                    'name' => 'Allowance',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 10,
                    'name' => 'Toys',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 10,
                    'name' => 'Kids Discretionary Spending',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 10,
                    'name' => 'Child Support',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 10,
                    'name' => 'Kids Clothing',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 11,
                    'name' => 'Veterinarian Visits',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 11,
                    'name' => 'Pet Food',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 11,
                    'name' => 'Pet Medication',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 11,
                    'name' => 'Pet Toys/Beds',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 11,
                    'name' => 'Pet Accessories',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 11,
                    'name' => 'Pet Grooming',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 11,
                    'name' => 'Pet Insurance',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 12,
                    'name' => 'Netflix/Hulu',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 12,
                    'name' => 'Amazon Prime',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 12,
                    'name' => 'Music (Spotify, Pandora)',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 12,
                    'name' => 'Sports TV Subscription',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 12,
                    'name' => 'Software Subscriptions',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 12,
                    'name' => 'Magazines',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 12,
                    'name' => 'Professional Society Annual Fees',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 13,
                    'name' => 'Haircuts',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 13,
                    'name' => 'Hair Coloring',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 13,
                    'name' => 'Hair Products',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 13,
                    'name' => 'Cosmetics',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 13,
                    'name' => 'Nail Salon',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 13,
                    'name' => 'Eyebrows',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 13,
                    'name' => 'Massages',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 13,
                    'name' => 'Spa Services',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 13,
                    'name' => 'Grooming',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 13,
                    'name' => 'Gym Membership',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 13,
                    'name' => 'Counseling/Therapy',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 14,
                    'name' => 'Books',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 14,
                    'name' => 'Personal Coach',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 14,
                    'name' => 'Self-Improvement',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 14,
                    'name' => 'Conferences',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 14,
                    'name' => 'Online Courses',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 14,
                    'name' => 'In Person Courses',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 15,
                    'name' => 'Financial Advisor',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 15,
                    'name' => 'Lawyer/Attorney Fees',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 15,
                    'name' => 'Tax Professional',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 15,
                    'name' => 'Busines Consultant',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 16,
                    'name' => 'Movies',
                    'color' => 'green'
                ],
                [
                    'parent_id' => 16,
                    'name' => 'Concerts',
                    'color' => 'green'
                ],
                [
                    'parent_id' => 16,
                    'name' => 'Hobbies/Crafts',
                    'color' => 'green'
                ],
                [
                    'parent_id' => 16,
                    'name' => 'Hosting Parties',
                    'color' => 'green'
                ],
                [
                    'parent_id' => 16,
                    'name' => 'Books',
                    'color' => 'green'
                ],
                [
                    'parent_id' => 16,
                    'name' => 'Entertainment',
                    'color' => 'green'
                ],
                [
                    'parent_id' => 16,
                    'name' => 'Sporting Events',
                    'color' => 'green'
                ],
                [
                    'parent_id' => 17,
                    'name' => 'Vacation',
                    'color' => 'purple'
                ],
                [
                    'parent_id' => 17,
                    'name' => 'Trips to See Family',
                    'color' => 'purple'
                ],
                [
                    'parent_id' => 17,
                    'name' => 'Trips for Weddings, Bachelor/Bachelorette Parties',
                    'color' => 'purple'
                ],
                [
                    'parent_id' => 17,
                    'name' => 'Sourvenirs',
                    'color' => 'purple'
                ],
                [
                    'parent_id' => 17,
                    'name' => 'Baggage Fees',
                    'color' => 'purple'
                ],
                [
                    'parent_id' => 17,
                    'name' => 'TSA Precheck or Global Entry',
                    'color' => 'purple'
                ],
                [
                    'parent_id' => 18,
                    'name' => 'Mobile Phone',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 18,
                    'name' => 'Computer / Computer Accessories',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 18,
                    'name' => 'Speaker System',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 18,
                    'name' => 'WiFi Mesh System / WiFi Extender',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 18,
                    'name' => 'Smart Home',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 18,
                    'name' => 'Gaming System / Video Games / Gaming Accessories',
                    'color' => 'blue'
                ],
                [
                    'parent_id' => 19,
                    'name' => 'Family Birthday Gifts',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 19,
                    'name' => 'Friend Birthday Gifts',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 19,
                    'name' => 'Wedding / Wedding Shower Gifts',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 19,
                    'name' => 'Anniversary Gifts',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 19,
                    'name' => 'Baby / Baby Shower Gifts',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 19,
                    'name' => 'Teacher Gifts',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 19,
                    'name' => 'Service Person Gifts',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 19,
                    'name' => 'Thank You Gifts',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 19,
                    'name' => 'Holiday Gifts',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 19,
                    'name' => 'Special Occasions',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 20,
                    'name' => 'Charity / Donations',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 20,
                    'name' => 'Tithing',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 20,
                    'name' => 'Religious',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 20,
                    'name' => 'Community',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 20,
                    'name' => 'Political',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 20,
                    'name' => 'Non-cash Donations',
                    'color' => 'pink'
                ],
                [
                    'parent_id' => 21,
                    'name' => 'College Savings',
                    'color' => 'green'
                ],
                [
                    'parent_id' => 21,
                    'name' => 'Retirement Savings',
                    'color' => 'green'
                ],
                [
                    'parent_id' => 21,
                    'name' => 'New Car Savings',
                    'color' => 'green'
                ],
                [
                    'parent_id' => 21,
                    'name' => 'Health Savings Account / Plan',
                    'color' => 'green'
                ],
                [
                    'parent_id' => 21,
                    'name' => 'Emergency Fund',
                    'color' => 'green'
                ],
                [
                    'parent_id' => 21,
                    'name' => 'Brokerage Investments',
                    'color' => 'green'
                ],
                [
                    'parent_id' => 21,
                    'name' => 'Traditional / Roth IRA',
                    'color' => 'green'
                ],
                [
                    'parent_id' => 21,
                    'name' => 'Down Payment Savings',
                    'color' => 'green'
                ],
                [
                    'parent_id' => 22,
                    'name' => 'Credit Card Debt',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 22,
                    'name' => 'Student Loan Debt',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 22,
                    'name' => 'Medical Debt',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 22,
                    'name' => 'Personal Loans',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 22,
                    'name' => 'Auto Loan Payments',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 22,
                    'name' => 'Back Taxes',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 22,
                    'name' => 'Past Due Bills',
                    'color' => 'red'
                ],
                [
                    'parent_id' => 22,
                    'name' => 'Alimony',
                    'color' => 'red'
                ]
            ]
        );
    }
}
