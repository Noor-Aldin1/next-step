<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MentorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mentors')->insert([
            [
                'user_id' => 1, // Assuming user_id 1 exists
                'availability' => 'Monday to Friday, 9 AM to 5 PM', // Availability details
                'video' => 'mentor1_video_link.mp4', // Video link or path
                'status' => 'active', // Mentor is active
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // Assuming user_id 2 exists
                'availability' => 'Tuesday and Thursday, 2 PM to 6 PM', // Availability details
                'video' => 'mentor2_video_link.mp4', // Video link or path
                'status' => 'inactive', // Mentor is inactive
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3, // Assuming user_id 3 exists
                'availability' => 'Monday to Friday, 10 AM to 4 PM', // Availability details
                'video' => 'mentor3_video_link.mp4', // Video link or path
                'status' => 'active', // Mentor is active
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
