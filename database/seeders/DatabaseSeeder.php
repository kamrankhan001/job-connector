<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Company;
use App\Models\JobSeeker;
use App\Models\JobsListing;
use App\Models\Application;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a single admin user
        User::factory()->admin()->create();

        // Create 5 companies and associated jobs
        Company::factory(5)->create()->each(function ($company) {
            JobsListing::factory(3)->create(['company_id' => $company->id]);
        });

        // Create 10 job seekers
        // JobSeeker::factory(10)->create();

        // Create job applications for each job seeker
        // Application::factory(10)->create();
    }
}
