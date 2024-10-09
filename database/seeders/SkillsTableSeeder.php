<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillsTableSeeder extends Seeder
{
    public function run()
    {
        // Sample skills data
        $skills = [
            ['name' => 'PHP'],
            ['name' => 'JavaScript'],
            ['name' => 'Laravel'],
            ['name' => 'React'],
            ['name' => 'HTML'],
            ['name' => 'CSS'],
            ['name' => 'MySQL'],
            ['name' => 'Python'],
            ['name' => 'Java'],
            ['name' => 'C#'],
        ];

        // Insert data into the skills table
        DB::table('skills')->insert($skills);
    }
}
