<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserMentorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample data for the user_mentor table
        DB::table('user_mentor')->insert([
            [
                'student_id' => 1, // Assuming a user with ID 1 exists
                'mentor_id' => 1, // Assuming a mentor with ID 1 exists
                'mentor_limit' => 3, // Assuming a mentor with ID 1 exists
            ],
            [
                'student_id' => 2, // Assuming a user with ID 2 exists
                'mentor_id' => 1, // Assuming a mentor with ID 1 exists
                'mentor_limit' => 1, // Assuming a mentor with ID 1 exists
            ],

        ]);
    }
}
