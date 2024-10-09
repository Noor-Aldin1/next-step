<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LiveChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('live_chat')->insert([
            [
                'user_id' => 1, // Assuming user with ID 1 exists
                'admin_id' => 2, // Assuming admin with ID 2 exists
                'message' => 'Hello, I need help with my account.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3, // Assuming user with ID 3 exists
                'admin_id' => 2, // Assuming admin with ID 2 exists
                'message' => 'Can you assist me with my order?',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1, // Assuming user with ID 1 exists
                'admin_id' => 3, // Assuming admin with ID 3 exists
                'message' => 'I would like to know more about the services.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more entries as needed
        ]);
    }
}
