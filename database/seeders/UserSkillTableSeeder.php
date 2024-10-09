<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserSkillTableSeeder extends Seeder
{
    public function run()
    {
        // Temporarily disable foreign key checks to avoid conflicts during seeding
        Schema::disableForeignKeyConstraints();

        // Sample data for user_skill table
        $userSkills = [
            ['user_id' => 1, 'skill_id' => 1, 'rate' => 8],
            ['user_id' => 1, 'skill_id' => 2, 'rate' => 7],
            ['user_id' => 2, 'skill_id' => 1, 'rate' => 9],
            ['user_id' => 2, 'skill_id' => 3, 'rate' => 6],
            ['user_id' => 3, 'skill_id' => 4, 'rate' => 5],
            ['user_id' => 3, 'skill_id' => 5, 'rate' => 8],
            ['user_id' => 1, 'skill_id' => 6, 'rate' => 7],
        ];

        // Truncate the user_skill table to prevent duplicate entries
        DB::table('user_skill')->truncate();

        // Insert data into the user_skill table
        DB::table('user_skill')->insert($userSkills);

        // Re-enable foreign key checks
        Schema::enableForeignKeyConstraints();
    }
}
