<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employers')->insert([
            [
                'company_name' => 'Tech Innovators',
                'business_sector' => 'Technology',
                'employee_num' => 200,
                'city' => 'San Francisco',
                'account_manager' => 'John Doe',
                'phone' => '123-456-7890',
                'user_id' => 1, // Assuming user with ID 1 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_name' => 'Creative Minds',
                'business_sector' => 'Marketing',
                'employee_num' => 50,
                'city' => 'New York',
                'account_manager' => 'Jane Smith',
                'phone' => '987-654-3210',
                'user_id' => 2, // Assuming user with ID 2 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_name' => 'Health Solutions',
                'business_sector' => 'Healthcare',
                'employee_num' => 500,
                'city' => 'Los Angeles',
                'account_manager' => 'Mary Johnson',
                'phone' => '555-123-4567',
                'user_id' => 3, // Assuming user with ID 3 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
