<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\JobsListing;
use App\Models\Application;
use App\Models\JobSeeker;

class HomeController extends Controller
{
    /**
     * Display a listing of all job listings.
     *
     * @return View
     */
    public function index(): View
    {
        // Retrieve all job listings, ordered by the latest, and pass them to the view
        $jobs = JobsListing::latest()->get();

        return view('index', compact('jobs'));
    }

    /**
     * Display the details of a specific job listing.
     *
     * @param JobsListing $job
     * @return View
     */
    public function show(JobsListing $job): View
    {
        // Get the authenticated user's JobSeeker profile
        $jobSeeker = auth()->user()->jobSeeker;

        // Check if the job seeker has already applied for this job
        $isApplied = $jobSeeker && $jobSeeker->hasAppliedForJob($job);

        // Pass the job listing and the application status to the view
        return view('job-view', compact('job', 'isApplied'));
    }

    /**
     * Handle the application process for a specific job.
     *
     * @param JobsListing $job
     * @return RedirectResponse
     */
    public function apply(JobsListing $job): RedirectResponse
    {
        // Get the authenticated user's JobSeeker profile
        $jobSeeker = auth()->user()->jobSeeker;

        // If the job seeker is not has portfolio, redirect back with an error message
        if (!$jobSeeker) {
            return redirect()->back()->with('error', 'You need to create a portfolio as a job seeker to apply for jobs.');
        }

        // If the job seeker has already applied for the job, redirect back with a warning message
        if ($jobSeeker->hasAppliedForJob($job)) {
            return redirect()->back()->with('warning', 'You already applied for this job!');
        }

        // Create a new application record linking the job seeker to the job listing
        $jobSeeker->applications()->create([
            'jobs_listings_id' => $job->id,
        ]);

        // Redirect back with a success message indicating the application was submitted
        return redirect()->back()->with('success', 'Application submitted successfully.');
    }
}
