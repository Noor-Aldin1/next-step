<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobPostingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('job_postings')->insert([
            [
                'employer_id' => 1, // Assuming employer with ID 1 exists
                'title' => 'Software Engineer',
                'description' => 'We are looking for a talented software engineer to join our team.',
                'requirements' => 'Proficiency in PHP, Laravel, JavaScript, and React.',
                'company_name' => 'Tech Innovators',
                'position' => 'Junior Software Engineer',
                'job_type' => 'Full-time',
                'experience' => '1-3 years',
                'salary' => 4500.00,
                'post_due' => '2024-12-01',
                'last_date_to_apply' => '2024-12-15',
                'city' => 'Amman',
                'Address' => '5th Circle, Amman',
                'education_level' => 'Bachelor\'s Degree',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employer_id' => 2, // Assuming employer with ID 2 exists
                'title' => 'Marketing Specialist',
                'description' => 'Join our marketing team to help craft marketing strategies.',
                'requirements' => 'Knowledge of SEO, content marketing, and campaign management.',
                'company_name' => 'Creative Minds',
                'position' => 'Marketing Specialist',
                'job_type' => 'Part-time',
                'experience' => '2-5 years',
                'salary' => 3000.00,
                'post_due' => '2024-11-20',
                'last_date_to_apply' => '2024-12-05',
                'city' => 'Zarqa',
                'Address' => 'Main Street, Zarqa',
                'education_level' => 'Bachelor\'s Degree',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employer_id' => 3, // Assuming employer with ID 3 exists
                'title' => 'Data Analyst',
                'description' => 'Analyze data and provide insights for business decisions.',
                'requirements' => 'Strong skills in SQL, Excel, and Power BI.',
                'company_name' => 'Health Solutions',
                'position' => 'Data Analyst',
                'job_type' => 'Contract',
                'experience' => '3-5 years',
                'salary' => 5500.00,
                'post_due' => '2024-10-15',
                'last_date_to_apply' => '2024-10-30',
                'city' => 'Irbid',
                'Address' => 'King Abdullah Street, Irbid',
                'education_level' => 'Master\'s Degree',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
