<?php

namespace App\Services\Categories;

use Modules\Category\Models\Category;
use Modules\Category\Models\Group;

class SeedUserCategories
{
    private $user;

    public function seed( $user )
    {
        $this->user = $user;
        $this->createGroups();
        $this->createSecondaryCategories();
    }

    private function createGroups()
    {
        Group::create([
            'user_id' => $this->user->id,
            'name' => 'Income',
        ]);

        Group::create([
            'user_id' => $this->user->id,
            'name' => 'Housing',
        ]);

        Group::create([
            'user_id' => $this->user->id,
            'name' => 'Home Services',
        ]);

        Group::create([
            'user_id' => $this->user->id,
            'name' => 'Utilities',
        ]);

        Group::create([
            'user_id' => $this->user->id,
            'name' => 'Household Items',
        ]);

        Group::create([
            'user_id' => $this->user->id,
            'name' => 'Food',
        ]);

        Group::create([
            'user_id' => $this->user->id,
            'name' => 'Transportation',
        ]);

        Group::create([
            'user_id' => $this->user->id,
            'name' => 'Medical/Health',
        ]);

        Group::create([
            'user_id' => $this->user->id,
            'name' => 'Insurance',
        ]);

        Group::create([
            'user_id' => $this->user->id,
            'name' => 'Kids',
        ]);

        Group::create([
            'user_id' => $this->user->id,
            'name' => 'Pets',
        ]);

        Group::create([
            'user_id' => $this->user->id,
            'name' => 'Subscriptions',
        ]);

        Group::create([
            'user_id' => $this->user->id,
            'name' => 'Personal Care',
        ]);

        Group::create([
            'user_id' => $this->user->id,
            'name' => 'Personal Development',
        ]);

        Group::create([
            'user_id' => $this->user->id,
            'name' => 'Financial/Professional Feeds',
        ]);

        Group::create([
            'user_id' => $this->user->id,
            'name' => 'Recreation/Fun',
        ]);

        Group::create([
            'user_id' => $this->user->id,
            'name' => 'Travel',
        ]);

        Group::create([
            'user_id' => $this->user->id,
            'name' => 'Technology',
        ]);

        Group::create([
            'user_id' => $this->user->id,
            'name' => 'Gifts',
        ]);

        Group::create([
            'user_id' => $this->user->id,
            'name' => 'Charitable Giving',
        ]);

        Group::create([
            'user_id' => $this->user->id,
            'name' => 'Savings Goals/Investing',
        ]);

        Group::create([
            'user_id' => $this->user->id,
            'name' => 'Debt Payments',
        ]);
    }

    private function createSecondaryCategories()
    {
        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 1,
            'name' => 'Salary & Wages',
            'color' => 'green'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 1,
            'name' => 'Self-employed Income',
            'color' => 'green'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 1,
            'name' => 'Bonus',
            'color' => 'green'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 1,
            'name' => 'Tips',
            'color' => 'green'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 1,
            'name' => 'Tax Refund',
            'color' => 'green'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 1,
            'name' => 'Gifts Received',
            'color' => 'green'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 1,
            'name' => 'Alimony Received',
            'color' => 'green'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 1,
            'name' => 'Child Support Received',
            'color' => 'green'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 1,
            'name' => 'Rental Income',
            'color' => 'green'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 1,
            'name' => 'Dividend Income',
            'color' => 'green'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 1,
            'name' => 'Interest Earned',
            'color' => 'green'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 2,
            'name' => 'Mortgage/Rent',
            'color' => 'purple'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 2,
            'name' => 'Homeowners association (HOA fees)',
            'color' => 'purple'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 2,
            'name' => 'Homeowners insurance / Renters insurance',
            'color' => 'purple'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 2,
            'name' => 'Property insurance (i.e. jewelry)',
            'color' => 'purple'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 2,
            'name' => 'Home repairs / Maintenance',
            'color' => 'purple'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 2,
            'name' => 'Property Taxes',
            'color' => 'purple'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 2,
            'name' => 'Home Improvement',
            'color' => 'purple'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 2,
            'name' => 'Furnishings',
            'color' => 'purple'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 3,
            'name' => 'House Cleaning',
            'color' => 'orange'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 3,
            'name' => 'Lawn Care',
            'color' => 'orange'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 3,
            'name' => 'Security System',
            'color' => 'orange'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 3,
            'name' => 'Pest Control',
            'color' => 'orange'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 4,
            'name' => 'Natural Gas / Electricity',
            'color' => 'gray'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 4,
            'name' => 'Landline / Home Phone',
            'color' => 'gray'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 4,
            'name' => 'Mobile Phone',
            'color' => 'gray'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 4,
            'name' => 'Home Internet',
            'color' => 'gray'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 4,
            'name' => 'Garbage',
            'color' => 'gray'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 4,
            'name' => 'Recycling',
            'color' => 'gray'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 4,
            'name' => 'Water',
            'color' => 'gray'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 4,
            'name' => 'Sewer',
            'color' => 'gray'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 5,
            'name' => 'Cleaning Supplies',
            'color' => 'gray'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 5,
            'name' => 'Home Improvement',
            'color' => 'gray'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 5,
            'name' => 'Paper Products',
            'color' => 'gray'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 5,
            'name' => 'Toiletries',
            'color' => 'gray'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 5,
            'name' => 'Laundry Supplies',
            'color' => 'gray'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 5,
            'name' => 'Postage',
            'color' => 'gray'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 5,
            'name' => 'Furniture',
            'color' => 'gray'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 5,
            'name' => 'Home Decor',
            'color' => 'gray'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 5,
            'name' => 'Pool Supplies',
            'color' => 'gray'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 6,
            'name' => 'Groceries',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 6,
            'name' => 'Fast Food',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 6,
            'name' => 'Coffee Shops',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 6,
            'name' => 'Breakfast',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 6,
            'name' => 'Lunch',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 6,
            'name' => 'Dinner',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 6,
            'name' => 'Drinks',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 6,
            'name' => 'Snacks',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 7,
            'name' => 'Car Payment / Lease Payments',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 7,
            'name' => 'Car Insurance',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 7,
            'name' => 'Gas',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 7,
            'name' => 'Oil Change',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 7,
            'name' => 'Maintenance / Repairs',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 7,
            'name' => 'Personal Property Taxes',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 7,
            'name' => 'Registration',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 7,
            'name' => 'Public Transportation',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 7,
            'name' => 'Ride Sharing (Uber, Lyft)',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 7,
            'name' => 'Tolls',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 7,
            'name' => 'Parking Fees',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 7,
            'name' => 'Roadside Assistance (AAA)',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 8,
            'name' => 'Health Insurance',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 8,
            'name' => 'Dental Insurance',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 8,
            'name' => 'Vision Insurance',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 8,
            'name' => 'Prescriptions / Medication',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 8,
            'name' => 'Doctor Bills',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 8,
            'name' => 'Dentist Visits',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 8,
            'name' => 'Hospital Bills',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 8,
            'name' => 'Optometrist',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 8,
            'name' => 'Glasses, Contacts',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 8,
            'name' => 'Chiropractor Visits',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 8,
            'name' => 'Vitamins/Supplements',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 9,
            'name' => 'Life Insurance',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 9,
            'name' => 'Disability Insurance',
            'color' => 'red'
        ]);
        
        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 9,
            'name' => 'Long-term Care Insurance',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 9,
            'name' => 'Umbrella Policy',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 9,
            'name' => 'Identity Theft',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 10,
            'name' => 'Tuition',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 10,
            'name' => 'Daycare',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 10,
            'name' => 'Babysitter / Nanny',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 10,
            'name' => 'Diapers, Formula - Baby Necessities',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 10,
            'name' => 'Summer Camp',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 10,
            'name' => 'School or Extra-curricular activities',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 10,
            'name' => 'School Supplies',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 10,
            'name' => 'School Lunches',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 10,
            'name' => 'Lessons',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 10,
            'name' => 'Allowance',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 10,
            'name' => 'Toys',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 10,
            'name' => 'Kids Discretionary Spending',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 10,
            'name' => 'Child Support',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 10,
            'name' => 'Kids Clothing',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 11,
            'name' => 'Veterinarian Visits',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 11,
            'name' => 'Pet Food',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 11,
            'name' => 'Pet Medication',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 11,
            'name' => 'Pet Toys/Beds',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 11,
            'name' => 'Pet Accessories',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 11,
            'name' => 'Pet Grooming',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 11,
            'name' => 'Pet Insurance',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 12,
            'name' => 'Netflix/Hulu',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 12,
            'name' => 'Amazon Prime',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 12,
            'name' => 'Music (Spotify, Pandora)',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 12,
            'name' => 'Sports TV Subscription',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 12,
            'name' => 'Software Subscriptions',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 12,
            'name' => 'Magazines',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 12,
            'name' => 'Professional Society Annual Fees',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 13,
            'name' => 'Haircuts',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 13,
            'name' => 'Hair Coloring',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 13,
            'name' => 'Hair Products',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 13,
            'name' => 'Cosmetics',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 13,
            'name' => 'Nail Salon',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 13,
            'name' => 'Eyebrows',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 13,
            'name' => 'Massages',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 13,
            'name' => 'Spa Services',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 13,
            'name' => 'Grooming',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 13,
            'name' => 'Gym Membership',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 13,
            'name' => 'Counseling/Therapy',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 14,
            'name' => 'Books',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 14,
            'name' => 'Personal Coach',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 14,
            'name' => 'Self-Improvement',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 14,
            'name' => 'Conferences',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 14,
            'name' => 'Online Courses',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 14,
            'name' => 'In Person Courses',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 15,
            'name' => 'Financial Advisor',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 15,
            'name' => 'Lawyer/Attorney Fees',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 15,
            'name' => 'Tax Professional',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 15,
            'name' => 'Busines Consultant',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 16,
            'name' => 'Movies',
            'color' => 'green'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 16,
            'name' => 'Concerts',
            'color' => 'green'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 16,
            'name' => 'Hobbies/Crafts',
            'color' => 'green'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 16,
            'name' => 'Hosting Parties',
            'color' => 'green'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 16,
            'name' => 'Books',
            'color' => 'green'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 16,
            'name' => 'Entertainment',
            'color' => 'green'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 16,
            'name' => 'Sporting Events',
            'color' => 'green'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 17,
            'name' => 'Vacation',
            'color' => 'purple'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 17,
            'name' => 'Trips to See Family',
            'color' => 'purple'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 17,
            'name' => 'Trips for Weddings, Bachelor/Bachelorette Parties',
            'color' => 'purple'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 17,
            'name' => 'Sourvenirs',
            'color' => 'purple'
        ]);
        
        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 17,
            'name' => 'Baggage Fees',
            'color' => 'purple'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 17,
            'name' => 'TSA Precheck or Global Entry',
            'color' => 'purple'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 18,
            'name' => 'Mobile Phone',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 18,
            'name' => 'Computer / Computer Accessories',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 18,
            'name' => 'Speaker System',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 18,
            'name' => 'WiFi Mesh System / WiFi Extender',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 18,
            'name' => 'Smart Home',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 18,
            'name' => 'Gaming System / Video Games / Gaming Accessories',
            'color' => 'blue'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 19,
            'name' => 'Family Birthday Gifts',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 19,
            'name' => 'Friend Birthday Gifts',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 19,
            'name' => 'Wedding / Wedding Shower Gifts',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 19,
            'name' => 'Anniversary Gifts',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 19,
            'name' => 'Baby / Baby Shower Gifts',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 19,
            'name' => 'Teacher Gifts',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 19,
            'name' => 'Service Person Gifts',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 19,
            'name' => 'Thank You Gifts',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 19,
            'name' => 'Holiday Gifts',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 19,
            'name' => 'Special Occasions',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 20,
            'name' => 'Charity / Donations',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 20,
            'name' => 'Tithing',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 20,
            'name' => 'Religious',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 20,
            'name' => 'Community',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 20,
            'name' => 'Political',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 20,
            'name' => 'Non-cash Donations',
            'color' => 'pink'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 21,
            'name' => 'College Savings',
            'color' => 'green'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 21,
            'name' => 'Retirement Savings',
            'color' => 'green'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 21,
            'name' => 'New Car Savings',
            'color' => 'green'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 21,
            'name' => 'Health Savings Account / Plan',
            'color' => 'green'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 21,
            'name' => 'Emergency Fund',
            'color' => 'green'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 21,
            'name' => 'Brokerage Investments',
            'color' => 'green'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 21,
            'name' => 'Traditional / Roth IRA',
            'color' => 'green'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 21,
            'name' => 'Down Payment Savings',
            'color' => 'green'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 22,
            'name' => 'Credit Card Debt',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 22,
            'name' => 'Student Loan Debt',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 22,
            'name' => 'Medical Debt',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 22,
            'name' => 'Personal Loans',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 22,
            'name' => 'Auto Loan Payments',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 22,
            'name' => 'Back Taxes',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 22,
            'name' => 'Past Due Bills',
            'color' => 'red'
        ]);

        Category::create([
            'user_id' => $this->user->id,
            'group_id' => 22,
            'name' => 'Alimony',
            'color' => 'red'
        ]);
    }
}