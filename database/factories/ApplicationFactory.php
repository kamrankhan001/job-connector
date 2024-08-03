<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'jobs_listings_id' => \App\Models\JobsListing::factory(),
            'job_seeker_id' => \App\Models\JobSeeker::factory(),
            'cover_letter' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['applied', 'reviewed', 'interviewed', 'hired', 'rejected']),
            'applied_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
