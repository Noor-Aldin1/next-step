<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        DB::table('payments')->insert([
            [
                'subscription_id' => 1, // Make sure this subscription exists in user_subscriptions
                'amount' => 9.99, // Amount paid for the Basic Plan
                'payment_date' => now(),
                'payment_status' => 'completed', // Payment status
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subscription_id' => 2, // Make sure this subscription exists
                'amount' => 49.99, // Amount paid for the Pro Plan
                'payment_date' => now()->subDays(10), // Payment made 10 days ago
                'payment_status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subscription_id' => 3, // Another subscription
                'amount' => 99.99, // Amount paid for the Enterprise Plan
                'payment_date' => now()->subDays(30), // Payment made 30 days ago
                'payment_status' => 'failed', // Failed payment
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
