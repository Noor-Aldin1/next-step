<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LecturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lectures')->insert([
            [
                'mentor_id' => 1, // Assuming mentor with ID 1 exists
                'title' => 'Introduction to Programming',
                'description' => 'A comprehensive introduction to programming concepts and methodologies.',
                'linke_lecture' => 'http://example.com/lecture1', // Replace with actual link
                'start_session' => now()->addDays(1), // Example start session date
                'end_session' => now()->addDays(5), // Example end session date
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mentor_id' => 2, // Assuming mentor with ID 2 exists
                'title' => 'Advanced JavaScript',
                'description' => 'Deep dive into JavaScript, including ES6 features and frameworks.',
                'linke_lecture' => 'http://example.com/lecture2', // Replace with actual link
                'start_session' => now()->addDays(2), // Example start session date
                'end_session' => now()->addDays(6), // Example end session date
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mentor_id' => 3, // Assuming mentor with ID 3 exists
                'title' => 'Database Management Systems',
                'description' => 'Understanding different types of database systems and their applications.',
                'linke_lecture' => 'http://example.com/lecture3', // Replace with actual link
                'start_session' => now()->addDays(3), // Example start session date
                'end_session' => now()->addDays(7), // Example end session date
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more entries as needed
        ]);
    }
}
