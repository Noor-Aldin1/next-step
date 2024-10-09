<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseTasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('course_tasks')->insert([
            [
                'course_id' => 1, // Assuming course with ID 1 exists
                'task_id' => 1, // Assuming task with ID 1 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 1, // Assuming course with ID 1 exists
                'task_id' => 2, // Assuming task with ID 2 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 2, // Assuming course with ID 2 exists
                'task_id' => 3, // Assuming task with ID 3 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more entries as needed
        ]);
    }
}
