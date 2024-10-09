<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            [
                'user_id' => 1, // Assuming user_id 1 exists in the users table
                'name' => 'Project Alpha',
                'description' => 'Description for Project Alpha.',
                'start_due' => '2024-01-01',
                'end_due' => '2024-02-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // Assuming user_id 2 exists in the users table
                'name' => 'Project Beta',
                'description' => 'Description for Project Beta.',
                'start_due' => '2024-03-01',
                'end_due' => '2024-04-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3, // Assuming user_id 3 exists in the users table
                'name' => 'Project Gamma',
                'description' => 'Description for Project Gamma.',
                'start_due' => '2024-05-01',
                'end_due' => '2024-06-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}