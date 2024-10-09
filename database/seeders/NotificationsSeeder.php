<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('notifications')->insert([
            [
                'user_id' => 1, // Assuming user with ID 1 exists
                'content' => 'Welcome to our platform! We are glad to have you.',
                'created_at' => now(),
            ],
            [
                'user_id' => 2, // Assuming user with ID 2 exists
                'content' => 'Your application has been received successfully.',
                'created_at' => now(),
            ],
            [
                'user_id' => 1, // Assuming user with ID 1 exists
                'content' => 'You have a new message from your mentor.',
                'created_at' => now(),
            ],
            [
                'user_id' => 3, // Assuming user with ID 3 exists
                'content' => 'Don’t forget to complete your profile!',
                'created_at' => now(),
            ],
            // Add more entries as needed
        ]);
    }
}
