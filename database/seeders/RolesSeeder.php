<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'user', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'mentor', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'employer', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'admin', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
