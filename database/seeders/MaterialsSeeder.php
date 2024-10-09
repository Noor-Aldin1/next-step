<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('materials')->insert([
            [
                'mentor_id' => 1, // Assuming mentor with ID 1 exists
                'title' => 'Intro to Laravel',
                'description' => 'A comprehensive guide to get started with Laravel framework.',
                'file_path' => 'uploads/materials/intro_to_laravel.pdf', // Replace with actual file path
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mentor_id' => 2, // Assuming mentor with ID 2 exists
                'title' => 'Advanced PHP Techniques',
                'description' => 'Deep dive into advanced features of PHP programming.',
                'file_path' => 'uploads/materials/advanced_php.pdf', // Replace with actual file path
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mentor_id' => 3, // Assuming mentor with ID 3 exists
                'title' => 'Database Design Fundamentals',
                'description' => 'Understanding the principles of database design.',
                'file_path' => 'uploads/materials/database_design.pdf', // Replace with actual file path
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more entries as needed
        ]);
    }
}
