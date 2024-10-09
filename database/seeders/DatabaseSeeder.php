<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // RolesSeeder::class,
            UserSeeder::class,
            JobCategorySeeder::class,
            CourseSeeder::class,
            EmployerSeeder::class,
            JobPostingSeeder::class,
            ApplicationSeeder::class,
            MentorSeeder::class,
            ProfileSeeder::class,
            VerificationSeeder::class,
            CommentsSeeder::class,
            LiveChatSeeder::class,
            ProjectsTableSeeder::class,
            CertificationTableSeeder::class,
            ExperienceTableSeeder::class,
            NotificationsSeeder::class,
            TrialSessionsSeeder::class,
            TasksSeeder::class,
            LecturesSeeder::class,
            MaterialsSeeder::class,
            StudentTasksSeeder::class,
            CourseStudentsSeeder::class,
            CourseTasksSeeder::class,
            CourseLecturesSeeder::class,
            CourseMaterialsSeeder::class,
            StudentMaterialsSeeder::class,
            JobPostingCategoriesSeeder::class,
            RatingsSeeder::class,
            SkillsTableSeeder::class,
            UserSkillTableSeeder::class,
            PackageSeeder::class,
            UserSubscriptionSeeder::class,
            PaymentSeeder::class,
        ]);
    }
}
