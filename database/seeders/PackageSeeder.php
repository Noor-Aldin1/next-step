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
                'attributes' => json_encode(['duration' => '1 month', 'support' => 'email']),
                'price' => 9.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pro Plan',
                'attributes' => json_encode(['duration' => '6 months', 'support' => 'email, phone']),
                'price' => 49.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Enterprise Plan',
                'attributes' => json_encode(['duration' => '12 months', 'support' => 'priority support']),
                'price' => 99.99,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
