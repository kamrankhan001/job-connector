<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\JobsListing;

class HomeController extends Controller
{
    /**
     * Display a listing of job listings based on user location.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $userCity = $this->getUserCity($request->ip());

        $jobs = JobsListing::byLocation($userCity)->latest()->get();

        return view('index', compact('jobs'));
    }

    /**
     * Search for jobs based on user input.
     *
     * @param Request $request
     * @return View
     */
    public function findJob(Request $request): View
    {
        // Retrieve the search inputs
        $job = $request->input('job');
        $location = $request->input('location');

        // Fetch the jobs based on the search criteria
        $jobs = JobsListing::byTitle($job)->byLocation($location)->latest()->get();

        // Pass the input values back to the view
        return view('index', compact('jobs', 'job', 'location'));
    }

    /**
     * Display the details of a specific job listing.
     *
     * @param JobsListing $job
     * @return View
     */
    public function showJob(JobsListing $job): View
    {
        $isApplied = auth()->user()?->jobSeeker?->hasAppliedForJob($job) ?? false;

        // Pass the job listing and the application status to the view
        return view('job-view', compact('job', 'isApplied'));
    }

    /**
     * Handle the application process for a specific job.
     *
     * @param JobsListing $job
     * @return RedirectResponse
     */
    public function applyForJob(JobsListing $job): RedirectResponse
    {
        $jobSeeker = auth()->user()?->jobSeeker;

        if (!$jobSeeker) {
            return redirect()->back()->with('error', 'You need to create a portfolio as a job seeker to apply for jobs.');
        }

        if ($jobSeeker->hasAppliedForJob($job)) {
            return redirect()->back()->with('warning', 'You already applied for this job!');
        }

        // Create a new application record linking the job seeker to the job listing
        $jobSeeker->applications()->create([
            'jobs_listings_id' => $job->id,
        ]);

        return redirect()->back()->with('success', 'Application submitted successfully.');
    }

    /**
     * Fetch the user's city based on their IP address.
     *
     * @param string $ip
     * @return string
     */
    private function getUserCity(string $ip): string
    {
        // For local development and testing, IP is hard-coded
        if ($ip === '127.0.0.1') {
            return 'Unknown';
        }

        // Default city in case API fails
        $defaultCity = 'Unknown';

        // Getting user city
        try {
            $response = Http::get('https://ipinfo.io/' . $ip, [
                'token' => 'ef0cd9b6bfe529',
            ]);

            $locationData = $response->json();
            return $locationData['city'] ?? $defaultCity;
        } catch (\Exception $e) {
            \Log::error('Failed to fetch user location: ' . $e->getMessage());
        }

        return $defaultCity;
    }
}
