<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample roles data
        $roles = [
            ['id' => 1, 'name' => 'user'],
            ['id' => 2, 'name' => 'mentor'],
            ['id' => 3, 'name' => 'employer'],
            ['id' => 4, 'name' => 'admin'],
        ];

        // Inserting roles if not already present
        DB::table('roles')->insertOrIgnore($roles);

        // Sample users data
        $users = [
            [
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'), // Use bcrypt for hashing
                'photo' => 'images/user.jpg',
                'role_id' => 4, // Admin
            ],
            [
                'username' => 'user1',
                'email' => 'user1@example.com',
                'password' => bcrypt('password'), // Use bcrypt for hashing
                'photo' => 'images/user.jpg',
                'role_id' => 1, // User
            ],
            [
                'username' => 'user2',
                'email' => 'user2@example.com',
                'password' => bcrypt('password'), // Use bcrypt for hashing
                'photo' => 'images/user.jpg',
                'role_id' => 1, // User
            ],
        ];

        // Inserting users
        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }
    }
}