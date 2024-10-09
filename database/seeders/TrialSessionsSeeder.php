<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrialSessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('trial_sessions')->insert([
            [
                'user_id' => 1, // Assuming user with ID 1 exists
                'start_date' => '2024-09-01',
                'end_date' => '2024-09-30',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // Assuming user with ID 2 exists
                'start_date' => '2024-08-15',
                'end_date' => '2024-09-15',
                'status' => 'expired',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3, // Assuming user with ID 3 exists
                'start_date' => '2024-09-10',
                'end_date' => '2024-10-10',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more entries as needed
        ]);
    }
}
