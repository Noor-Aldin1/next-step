<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employer>
 */
class EmployerFactory extends Factory
{
    protected $model = \App\Models\Employer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'company_name' => $this->faker->company,
            'business_sector' => $this->faker->word,
            'employee_num' => $this->faker->numberBetween(1, 500),
            'city' => $this->faker->city,
            'account_manager' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'user_id' => 3, // Assuming you want to associate a user with the employer
        ];
    }
}
