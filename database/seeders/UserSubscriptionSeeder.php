<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSubscriptionSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_subscriptions')->insert([
            [
                'user_id' => 1, // Make sure this user exists in the users table
                'package_id' => 1, // Make sure this package exists in the packages table
                'start_date' => now(),
                'end_date' => now()->addMonths(1), // 1 month subscription
                'number_month' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // Another user
                'package_id' => 2, // Another package
                'start_date' => now(),
                'end_date' => now()->addMonths(6), // 6 months subscription
                'number_month' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3, // Another user
                'package_id' => 3, // Enterprise plan package
                'start_date' => now(),
                'end_date' => now()->addMonths(12), // 12 months subscription
                'number_month' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
