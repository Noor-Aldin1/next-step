<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tasks')->insert([
            [
                'mentor_id' => 1, // Assuming mentor with ID 1 exists
                'title' => 'Create a project plan',
                'description' => 'Develop a detailed project plan for the new application.',
                'due_date' => '2024-10-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mentor_id' => 2, // Assuming mentor with ID 2 exists
                'title' => 'Conduct a coding workshop',
                'description' => 'Organize a coding workshop for beginners.',
                'due_date' => '2024-10-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mentor_id' => 3, // Assuming mentor with ID 3 exists
                'title' => 'Review mentee projects',
                'description' => 'Review the projects submitted by mentees and provide feedback.',
                'due_date' => '2024-10-20',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more entries as needed
        ]);
    }
}
