<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tasks')->insert([
            [
                'mentor_id' => 1, // Example mentor_id
                'title' => 'Introduction to Early Education',
                'description' => 'Complete the introduction to early education assignment.',
                'status' => 'pending',
                'due_date' => Carbon::now()->addDays(10), // Example due date
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'mentor_id' => 2, // Example mentor_id
                'title' => 'Advanced Teaching Methods',
                'description' => 'Prepare a report on advanced teaching methods.',
                'status' => 'in_progress',
                'due_date' => Carbon::now()->addDays(7), // Example due date
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'mentor_id' => 1, // Example mentor_id
                'title' => 'Child Development Studies',
                'description' => 'Research and submit findings on child development.',
                'status' => 'completed',
                'due_date' => Carbon::now()->subDays(2), // Example due date (past date)
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
