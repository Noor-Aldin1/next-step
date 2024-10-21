<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            [
                'title' => 'Introduction to Software Engineering',
                'description' => 'This course provides an introduction to the fundamentals of software engineering.',
                'photo' => 'images/courses/software_engineering.jpg', // Add a photo path
                'mentor_id' => 1, // Assuming user with ID 1 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Advanced Data Science',
                'description' => 'An advanced course that dives deep into machine learning and data science methodologies.',
                'photo' => 'images/courses/data_science.jpg', // Add a photo path
                'mentor_id' => 2, // Assuming user with ID 2 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Marketing Strategies',
                'description' => 'Learn the fundamentals of marketing strategies and how to apply them in the real world.',
                'photo' => 'images/courses/marketing_strategies.jpg', // Add a photo path
                'mentor_id' => 3, // Assuming user with ID 3 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
