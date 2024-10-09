<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ratings')->insert([
            [
                'mentor_id' => 1, // Assuming mentor with ID 1 exists
                'rating' => 5,
                'description' => 'Excellent mentor, very helpful!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mentor_id' => 1, // Assuming mentor with ID 1 exists
                'rating' => 4,
                'description' => 'Great experience, learned a lot.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mentor_id' => 2, // Assuming mentor with ID 2 exists
                'rating' => 3,
                'description' => 'Good but could improve on clarity.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mentor_id' => 2, // Assuming mentor with ID 2 exists
                'rating' => 5,
                'description' => 'Very knowledgeable and patient.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more entries as needed
        ]);
    }
}
