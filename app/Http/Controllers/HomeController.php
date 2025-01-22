<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Notifications\JobApplicationReceived;
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
        // Get the user's city based on their IP address
        $jobLocation = $this->getUserCity($request->ip());

        // Fetch jobs based on the user's city
        $jobs = JobsListing::query()
            ->byLocation($jobLocation)
            ->latest() // Order by latest job postings
            ->paginate(10); // Paginate results, 10 per page

        // Pass the jobs to the view
        return view('index', compact('jobs'));
    }

    /**
     * Search for jobs based on user input.
     *
     * @param Request $request
     * @return View
     */
    public function findJobs(Request $request): View
    {
        // Retrieve the title and location filters from the request
        $title = $request->input('job');
        $location = $request->input('location');

        // Fetch the jobs based on the search criteria
        $jobs = JobsListing::query()
            ->when($title, function ($query, $title) {
                return $query->byTitle($title); // Apply title filter if provided
            })
            ->when($location, function ($query, $location) {
                return $query->byLocation($location); // Apply location filter if provided
            })
            ->latest() // Order by latest job postings
            ->paginate(10); // Paginate results, 10 per page

        // Pass the input values and jobs to the view
        return view('index', compact('jobs', 'title', 'location'));
    }

    /**
     * Display the details of a specific job listing.
     *
     * @param JobsListing $job
     * @return View
     */
    public function showJob(JobsListing $job): View
    {
        // Check if the authenticated user has applied for this job
        $isApplied = auth()->user()?->jobSeeker?->hasAppliedForJob($job) ?? false;

        // Pass the job listing and the application status to the view
        return view('job-view', compact('job', 'isApplied'));
    }

    /**
     * Filter jobs based on multiple criteria.
     *
     * @param Request $request
     * @return View
     */
    public function filterJobs(Request $request): View
    {
        // Retrieve filter inputs from the request
        $title = $request->input('job');
        $location = $request->input('location');
        $jobPostedDate = $request->input('date');
        $jobSalary = $request->input('salary');
        $jobType = $request->input('job_type');

        // Construct the query based on filters
        $query = JobsListing::query();

        // Apply filters if they are provided
        if ($jobPostedDate) {
            $query->byPostedDate($jobPostedDate);
        }

        if (!empty($jobSalary)) {
            [$minSalary, $maxSalary] = explode('_', $jobSalary);
            $query->bySalary($minSalary, $maxSalary);
        }

        if ($jobType) {
            $query->byJobType($jobType);
        }

        if ($location) {
            $query->byLocation($location);
        }

        if ($title) {
            $query->byTitle($title);
        }

        // Get the filtered jobs
        $jobs = $query->latest()->paginate(10);

        // Pass the filtered jobs and filter criteria to the view
        return view('index', compact('jobs', 'title', 'location'));
    }

    /**
     * Handle the application process for a specific job.
     *
     * @param JobsListing $job
     * @return RedirectResponse
     */
    public function applyForJob(JobsListing $job): RedirectResponse
    {
        // Get the authenticated job seeker
        $jobSeeker = auth()->user()?->jobSeeker;

        // Check if the user is a job seeker
        if (!$jobSeeker) {
            return redirect()->back()->with('error', 'You need to create a portfolio as a job seeker to apply for jobs.');
        }

        // Check if the user has already applied for this job
        if ($jobSeeker->hasAppliedForJob($job)) {
            return redirect()->back()->with('warning', 'You already applied for this job!');
        }

        // Create a new application record
        $jobSeeker->applications()->create([
            'jobs_listings_id' => $job->id,
        ]);

        // Send notification to company
        $job->company->user->notify(new JobApplicationReceived($job));

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
            return 'bahawalpur';
        }

        // Default city in case API fails
        $defaultCity = 'Unknown';

        // Get user's city from IP address
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
