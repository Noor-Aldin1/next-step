<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseStudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('course_students')->insert([
            [
                'course_id' => 1, // Assuming course with ID 1 exists
                'student_id' => 1, // Assuming student with ID 1 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 1, // Assuming course with ID 1 exists
                'student_id' => 2, // Assuming student with ID 2 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 2, // Assuming course with ID 2 exists
                'student_id' => 1, // Assuming student with ID 1 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more entries as needed
        ]);
    }
}
