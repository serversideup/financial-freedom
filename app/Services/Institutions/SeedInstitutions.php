<?php

namespace App\Services\Institutions;

use App\Models\Institution;

class SeedInstitutions
{
    public function seedUnitedStates()
    {
        $institutions = [
            [
                'name' => 'Chase',
                'url' => 'https://www.chase.com/',
            ],
            [
                'name' => 'Bank of America',
                'url' => 'https://www.bankofamerica.com/',
            ],
            [
                'name' => 'Citi',
                'url' => 'https://www.citi.com/'
            ],
            [
                'name' => 'Wells Fargo',
                'url' => 'https://www.wellsfargo.com/'
            ],
            [
                'name' => 'Goldman Sachs',
                'url' => 'https://www.goldmansachs.com/'
            ],
            [
                'name' => 'Morgan Stanley',
                'url' => 'https://www.morganstanley.com/'
            ],
            [
                'name' => 'U.S. Bank',
                'url' => 'https://www.usbank.com/'
            ],
            [
                'name' => 'PNC Financial Services',
                'url' => 'https://www.pnc.com/'
            ],
            [
                'name' => 'TD Bank',
                'url' => 'https://www.td.com/'
            ],
            [
                'name' => 'Charles Schwab',
                'url' => 'https://www.schwab.com/'
            ],
            [
                'name' => 'BMO Financial Group',
                'url' => 'https://www.bmo.com/'
            ],
            [
                'name' => 'Capital One',
                'url' => 'https://www.capitalone.com/'
            ],
            [
                'name' => 'HSBC Bank USA',
                'url' => 'https://www.us.hsbc.com/'
            ],
            [
                'name' => 'Citizens Financial Group',
                'url' => 'https://www.citizensbank.com/'
            ],
            [
                'name' => 'M&T Bank',
                'url' => 'https://www.mtb.com/'
            ],
            [
                'name' => 'Fifth Third Bank',
                'url' => 'https://www.53.com/'
            ],
            [
                'name' => 'USAA',
                'url' => 'https://www.usaa.com/'
            ],
            [
                'name' => 'Ally',
                'url' => 'https://www.ally.com/'
            ],
            [
                'name' => 'UBS',
                'url' => 'https://www.ubs.com/'
            ],
            [
                'name' => 'East West Bank',
                'url' => 'https://www.eastwestbank.com/'
            ],
            [
                'name' => 'Associated Bank',
                'url' => 'https://www.associatedbank.com/'
            ]
        ];

        foreach( $institutions as $institution ){
            Institution::create( $institution );
        }
    }
}