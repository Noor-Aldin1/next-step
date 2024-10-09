<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('applications')->insert([
            [
                'job_id' => 1, // Assuming job_posting with ID 1 exists
                'user_id' => 2, // Assuming user with ID 2 exists
                'cv' => 'I am very interested in this position and believe I have the skills required.',
                'status' => 'Pending',
                'applied_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'job_id' => 2, // Assuming job_posting with ID 2 exists
                'user_id' => 3, // Assuming user with ID 3 exists
                'cv' => 'Looking forward to contributing my skills to your company.',
                'status' => 'Accepted',
                'applied_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'job_id' => 3, // Assuming job_posting with ID 3 exists
                'user_id' => 1, // Assuming user with ID 1 exists
                'cv' => 'I am eager to apply my experience to this role.',
                'status' => 'Rejected',
                'applied_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}