<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Employer; // Import the Employer model

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobPosting>
 */
class JobPostingFactory extends Factory
{
    protected $model = \App\Models\JobPosting::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employer_id' => 1, // Create an Employer for this JobPosting
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraph(),
            'requirements' => $this->faker->sentence(),
            'company_name' => $this->faker->company(),
            'position' => $this->faker->word(),
            'job_type' => $this->faker->randomElement(['Full-time', 'Part-time', 'Contract']),
            'experience' => $this->faker->randomElement(['Entry-level', 'Mid-level', 'Senior']),
            'salary' => $this->faker->numberBetween(30000, 120000),
            'post_due' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'last_date_to_apply' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'city' => $this->faker->city(),
            'education_level' => $this->faker->randomElement(['High School', 'Bachelor', 'Master', 'PhD']),
        ];
    }
}