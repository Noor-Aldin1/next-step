<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExperienceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('experience')->insert([
            [
                'user_id' => 1, // Assuming user_id 1 exists in the users table
                'position' => 'Software Developer',
                'company_name' => 'Company A',
                'description' => 'Worked on developing web applications.',
                'start_due' => '2022-01-01',
                'end_due' => '2023-01-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // Assuming user_id 2 exists in the users table
                'position' => 'Frontend Developer',
                'company_name' => 'Company B',
                'description' => 'Responsible for the frontend development of the project.',
                'start_due' => '2021-06-01',
                'end_due' => '2022-12-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3, // Assuming user_id 3 exists in the users table
                'position' => 'Backend Developer',
                'company_name' => 'Company C',
                'description' => 'Worked on API development and database management.',
                'start_due' => '2020-05-01',
                'end_due' => '2021-11-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
