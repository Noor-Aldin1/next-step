<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MentorMeetingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample data for the mentor_meetings table
        DB::table('mentor_meetings')->insert([
            [
                'mentor_id' => 1, // Assuming a mentor with ID 1 exists
                'user_id' => 1, // Assuming a user with ID 1 exists
                'meeting_time' => now()->addDays(1), // Meeting scheduled for 1 day later
                'meeting_link' => 'https://example.com/meeting1',
                'notes' => 'Discussed career goals.',
                'status' => 'scheduled',
            ],
            [
                'mentor_id' => 2, // Assuming a mentor with ID 2 exists
                'user_id' => 2, // Assuming a user with ID 2 exists
                'meeting_time' => now()->addDays(2), // Meeting scheduled for 2 days later
                'meeting_link' => 'https://example.com/meeting2',
                'notes' => 'Reviewed resume.',
                'status' => 'scheduled',
            ],
            [
                'mentor_id' => 1, // Assuming a mentor with ID 1 exists
                'user_id' => 3, // Assuming a user with ID 3 exists
                'meeting_time' => now()->addDays(3), // Meeting scheduled for 3 days later
                'meeting_link' => 'https://example.com/meeting3',
                'notes' => 'Discussed job applications.',
                'status' => 'scheduled',
            ],
        ]);
    }
}
