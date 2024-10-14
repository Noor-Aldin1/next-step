<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
{
    public function run()
    {
        DB::table('packages')->insert([
            [
                'name' => 'Basic Plan',
                'attributes' => json_encode([
                    'features' => [
                        'One-on-One Mentorship',
                        'Job Board Access',
                    ],
                    'details' => [
                        'Includes meetings, tailored assignments, valuable materials, certificates, and skills assessments',
                    ],
                ]),
                'price' => 19.99, // Adjusted to reflect more value
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pro Plan',
                'attributes' => json_encode([
                    'features' => [
                        'Ultimate Mentorship Experience',
                        'Tri-Mentor Access',
                    ],
                    'details' => [
                        'Includes advanced mentorship, access to three mentors, more comprehensive assignments, and premium job board features',
                    ],
                ]),
                'price' => 99.99, // Higher price for more comprehensive services
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
