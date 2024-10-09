<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentMaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('student_materials')->insert([
            [
                'material_id' => 1, // Assuming material with ID 1 exists
                'student_id' => 1, // Assuming student with ID 1 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'material_id' => 1, // Assuming material with ID 1 exists
                'student_id' => 2, // Assuming student with ID 2 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'material_id' => 2, // Assuming material with ID 2 exists
                'student_id' => 1, // Assuming student with ID 1 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more entries as needed
        ]);
    }
}
