<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Company;
use Faker\Factory;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $factory = Factory::create();
        
        $companies = Company::all();

        foreach($companies as $company){
            $count = rand(13, 15);

            for($i=0;$i<$count;$i++){
                Employee::create([
                    'first_name'=> $factory->firstName(),
                    'last_name' => $factory->lastName(),
                    'company_id'=> $company->id,
                    'email'=>$factory->unique()->safeEmail(),
                    'phone'=>$factory->phoneNumber(),
                    'is_active'=> rand(0,1)
                ]);
                $factory->unique(true);
            }
        }
    }
}
