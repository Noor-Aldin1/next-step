<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CertificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('certification')->insert([
            [
                'user_id' => 1, // Assuming user_id 1 exists in the users table
                'name' => 'Certified Laravel Developer',
                'start_due' => '2022-03-01',
                'end_due' => '2022-06-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // Assuming user_id 2 exists in the users table
                'name' => 'Certified PHP Developer',
                'start_due' => '2021-01-01',
                'end_due' => '2021-04-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3, // Assuming user_id 3 exists in the users table
                'name' => 'Certified Frontend Developer',
                'start_due' => '2020-05-01',
                'end_due' => '2020-09-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
