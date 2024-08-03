<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobsListing>
 */
class JobsListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => \App\Models\Company::factory(),
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->paragraph,
            'requirements' => $this->faker->sentence,
            'location' => $this->faker->city,
            'salary' => $this->faker->randomFloat(2, 30000, 100000),
            'job_type' => $this->faker->randomElement(['full_time', 'part_time', 'contract', 'internship']),
        ];
    }
}
