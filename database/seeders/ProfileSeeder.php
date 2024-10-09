<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('profiles')->insert([
            [
                'user_id' => 1, // Assuming user with ID 1 exists
                'full_name' => 'Noor Aldin Abo Alsaid',
                'phone' => '0962786121776',
                
                'major' => 'Management Information Systems',
                'university' => 'University of Jordan',
                'gap' => 'None',
                'email' => 'nooraldin.aboalsaid@gmail.com',
                'job_title' => 'Full Stack Developer',
                'country' => 'Jordan',
                'city' => 'Amman',
                'age' => 25,
                'language' => 'English, Arabic',
                'linkedin' => 'https://www.linkedin.com/in/nooraldin',
                'github' => 'https://github.com/Noor-Aldin2',
                'gender' => 'male', // New field for gender
                'about_me' => 'A passionate Full Stack Developer with a love for learning new technologies.', // New field for about me
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // Assuming user with ID 2 exists
                'full_name' => 'Sara Smith',
                'phone' => '0987654321',
                
                'major' => 'Computer Science',
                'university' => 'Yarmouk University',
                'gap' => 'None',
                'email' => 'sara.smith@example.com',
                'job_title' => 'Backend Developer',
                'country' => 'Jordan',
                'city' => 'Irbid',
                'age' => 28,
                'language' => 'English',
                'linkedin' => 'https://www.linkedin.com/in/sara-smith',
                'github' => 'https://github.com/sara-smith',
                'gender' => 'female', // New field for gender
                'about_me' => 'An experienced Backend Developer with expertise in building scalable applications.', // New field for about me
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}