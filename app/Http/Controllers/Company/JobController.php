<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\JobListingRequest;
use App\Models\JobsListing;

class JobController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Display a listing of jobs posted by the company.
     *
     * @return View
     */
    public function index(): View|RedirectResponse
    {
        // Retrieve the current company based on the authenticated user's ID
        $company = auth()->user()->company;

        if (is_null($company)) {
            return redirect()->route('company.profile')->with('warning', 'Please first make profile.');
        }

        // Fetch the jobs associated with the company and paginate the results
        $jobs = $company?->jobsListing()->latest()->paginate(10);

        return view('company.job.index', compact('jobs'));
    }

    /**
     * Display a specific job listing.
     *
     * @param JobsListing $job
     * @return View
     */
    public function show(JobsListing $job): View
    {
        return view('company.job.view', compact('job'));
    }

    /**
     * Show the form for creating a new job listing.
     *
     * @return View
     */
    public function create(): View|RedirectResponse
    {
        $company = auth()->user()->company;

        if (is_null($company)) {
            return redirect()->route('company.profile')->with('warning', 'Please first make profile.');
        }

        return view('company.job.create');
    }

    /**
     * Store a newly created job listing in storage.
     *
     * @param JobListingRequest $request
     * @return RedirectResponse
     */
    public function store(JobListingRequest $request): RedirectResponse
    {
        // Validate the request data
        $validated = $request->validated();

        // Create a new job listing using the company relationship
        auth()->user()->company->jobsListing()->create($validated);

        return redirect()->route('jobs')->with('success', 'Job listing created successfully!');
    }

    /**
     * Show the form for editing a job listing.
     *
     * @param JobsListing $job
     * @return View
     */
    public function edit(JobsListing $job): View
    {
        return view('company.job.edit', compact('job'));
    }

    /**
     * Update the specified job listing in storage.
     *
     * @param JobListingRequest $request
     * @param JobsListing $job
     * @return RedirectResponse
     */
    public function update(JobListingRequest $request, JobsListing $job): RedirectResponse
    {
        // Validate the request data
        $validated = $request->validated();

        // Update the job listing with validated data
        $job->update($validated);

        return redirect()->route('jobs')->with('success', 'Job updated successfully!');
    }

    /**
     * Remove the specified job listing from storage.
     *
     * @param JobsListing $job
     * @return RedirectResponse
     */
    public function destroy(JobsListing $job): RedirectResponse
    {
        // Delete the job listing
        $job->delete();

        return redirect()->route('jobs')->with('success', 'Job deleted successfully!');
    }
}
