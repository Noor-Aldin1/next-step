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
                'start_session' => now()->addDays(1)->setTime(10, 0), // Starts at 10:00 AM, 1 day later
                'end_session' => now()->addDays(1)->setTime(11, 0),   // Ends at 11:00 AM, 1 day later
                'meeting_link' => 'https://example.com/meeting1',
                'notes' => 'Discussed career goals.',
                'status' => 'scheduled',
            ],
            [
                'mentor_id' => 2, // Assuming a mentor with ID 2 exists
                'user_id' => 2, // Assuming a user with ID 2 exists
                'start_session' => now()->addDays(2)->setTime(14, 30), // Starts at 2:30 PM, 2 days later
                'end_session' => now()->addDays(2)->setTime(15, 30),   // Ends at 3:30 PM, 2 days later
                'meeting_link' => 'https://example.com/meeting2',
                'notes' => 'Reviewed resume.',
                'status' => 'scheduled',
            ],
            [
                'mentor_id' => 1, // Assuming a mentor with ID 1 exists
                'user_id' => 3, // Assuming a user with ID 3 exists
                'start_session' => now()->addDays(3)->setTime(9, 0),   // Starts at 9:00 AM, 3 days later
                'end_session' => now()->addDays(3)->setTime(10, 0),    // Ends at 10:00 AM, 3 days later
                'meeting_link' => 'https://example.com/meeting3',
                'notes' => 'Discussed job applications.',
                'status' => 'scheduled',
            ],
        ]);
    }
}
