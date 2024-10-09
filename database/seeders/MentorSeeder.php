<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MentorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mentors')->insert([
            [
                'user_id' => 1, // Assuming user with ID 1 exists
                'expertise' => 'Software Engineering',
                'availability' => 'Weekends',
                'university' => 'University of Jordan',
                'major' => 'Computer Science',
                'name' => 'John Doe',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // Assuming user with ID 2 exists
                'expertise' => 'Data Science',
                'availability' => 'Weekdays',
                'university' => 'Yarmouk University',
                'major' => 'Data Analytics',
                'name' => 'Jane Smith',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3, // Assuming user with ID 3 exists
                'expertise' => 'Artificial Intelligence',
                'availability' => 'Evenings',
                'university' => 'Hashemite University',
                'major' => 'AI and Robotics',
                'name' => 'Michael Brown',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
