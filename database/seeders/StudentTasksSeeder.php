<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentTasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('student_tasks')->insert([
            [
                'student_id' => 1, // Assuming student with ID 1 exists
                'task_id' => 1, // Assuming task with ID 1 exists
                'submission' => 'submission1.pdf', // Replace with actual submission file path
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 2, // Assuming student with ID 2 exists
                'task_id' => 2, // Assuming task with ID 2 exists
                'submission' => 'submission2.pdf', // Replace with actual submission file path
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 3, // Assuming student with ID 3 exists
                'task_id' => 1, // Assuming task with ID 1 exists
                'submission' => 'submission3.pdf', // Replace with actual submission file path
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more entries as needed
        ]);
    }
}
