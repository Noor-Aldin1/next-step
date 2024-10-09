<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseLecturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('course_lectures')->insert([
            [
                'course_id' => 1, // Assuming course with ID 1 exists
                'lecture_id' => 1, // Assuming lecture with ID 1 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 1, // Assuming course with ID 1 exists
                'lecture_id' => 2, // Assuming lecture with ID 2 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 2, // Assuming course with ID 2 exists
                'lecture_id' => 3, // Assuming lecture with ID 3 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more entries as needed
        ]);
    }
}
