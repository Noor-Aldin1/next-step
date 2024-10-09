<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobPostingCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('job_posting_categories')->insert([
            [
                'job_id' => 1, // Assuming job posting with ID 1 exists
                'category_id' => 1, // Assuming category with ID 1 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'job_id' => 1, // Assuming job posting with ID 1 exists
                'category_id' => 2, // Assuming category with ID 2 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'job_id' => 2, // Assuming job posting with ID 2 exists
                'category_id' => 1, // Assuming category with ID 1 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more entries as needed
        ]);
    }
}
