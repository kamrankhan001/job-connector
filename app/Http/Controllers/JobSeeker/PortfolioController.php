<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PortfolioRequest;
use App\Models\JobSeeker;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    /**
     * Display the user's portfolio.
     */
    public function index(): View
    {
        // Fetch the portfolio for the authenticated user
        $portfolio = JobSeeker::where('user_id', auth()->user()->id)->first();
        return view('job-seeker.portfolio.index', compact('portfolio'));
    }

    /**
     * Show the form for creating a new portfolio.
     */
    public function create(): View
    {
        return view('job-seeker.portfolio.create');
    }

    /**
     * Store a newly created portfolio in storage.
     */
    public function store(PortfolioRequest $request): RedirectResponse
    {
        // Store the resume file
        $resumePath = $request->file('resume')->store('resumes', 'public');

        // Create a new portfolio entry
        JobSeeker::create([
            'user_id' => auth()->user()->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'resume' => $resumePath,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('portfolio')->with('success', 'Portfolio created successfully.');
    }

    /**
     * Show the form for editing the specified portfolio.
     */
    public function edit(JobSeeker $portfolio): View
    {
        return view('job-seeker.portfolio.edit', compact('portfolio'));
    }

    /**
     * Update the specified portfolio in storage.
     */
    public function update(PortfolioRequest $request, JobSeeker $portfolio): RedirectResponse
    {
        // Initialize $resumePath with the current resume path of the portfolio
        $resumePath = $portfolio->resume;

        // Check if a new resume file has been uploaded
        if ($request->hasFile('resume')) {
            // Delete the old resume file if it exists
            if ($portfolio->resume) {
                Storage::delete($portfolio->resume);
            }

            // Store the new resume file and update the $resumePath with its new location
            $resumePath = $request->file('resume')->store('resumes', 'public');
        }

        // Update the portfolio record with the new data
        $portfolio->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'resume' => $resumePath,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('portfolio')->with('success', 'Portfolio updated successfully.');
    }
}
