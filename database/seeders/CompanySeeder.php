<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
             [
                'name' => 'Tata Elxsi',
                'email' => 'info@tataelxsi.com',
                'website' => 'https://www.tataelxsi.com'
            ],
            [
                'name' => 'Sasken Technologies',
                'email' => 'info@sasken.com',
                'website' => 'https://www.sasken.com'
            ],
            [
                'name' => 'Cyient',
                'email' => 'info@cyient.com',
                'website' => 'https://www.cyient.com'
            ],
            [
                'name' => 'Wipro',
                'email' => 'info@wipro.com',
                'website' => 'https://www.wipro.com'
            ]
        ];

        foreach($companies as $company){
            Company::create($company);
        }
    }
}
