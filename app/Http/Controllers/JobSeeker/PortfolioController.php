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
     * Display the job seeker's portfolio.
     *
     * @return View
     */
    public function index(): View
    {
        // Fetch the portfolio of the authenticated job seeker
        $portfolio = $this->getJobSeekerPortfolio();

        // Return the view with the portfolio data
        return view('job-seeker.portfolio.index', compact('portfolio'));
    }

    /**
     * Show the form for creating a new portfolio.
     *
     * @return View
     */
    public function create(): View
    {
        return view('job-seeker.portfolio.create');
    }

    /**
     * Store a newly created portfolio in storage.
     *
     * @param PortfolioRequest $request
     * @return RedirectResponse
     */
    public function store(PortfolioRequest $request): RedirectResponse
    {
        // Handle the creation of the job seeker's portfolio
        $this->createJobSeekerPortfolio($request);

        return redirect()->route('portfolio')->with('success', 'Portfolio created successfully.');
    }

    /**
     * Show the form for editing the specified portfolio.
     *
     * @param JobSeeker $portfolio
     * @return View
     */
    public function edit(JobSeeker $portfolio): View
    {
        return view('job-seeker.portfolio.edit', compact('portfolio'));
    }

    /**
     * Update the specified portfolio in storage.
     *
     * @param PortfolioRequest $request
     * @param JobSeeker $portfolio
     * @return RedirectResponse
     */
    public function update(PortfolioRequest $request, JobSeeker $portfolio): RedirectResponse
    {
        // Handle the update of the job seeker's portfolio
        $this->updateJobSeekerPortfolio($request, $portfolio);

        return redirect()->route('portfolio')->with('success', 'Portfolio updated successfully.');
    }

    /**
     * Get the authenticated job seeker's portfolio.
     *
     * @return JobSeeker|null
     */
    private function getJobSeekerPortfolio(): ?JobSeeker
    {
        // Use the relationship defined in the User model to fetch the job seeker's portfolio
        return auth()->user()->jobSeeker;
    }

    /**
     * Create a new job seeker's portfolio.
     *
     * @param PortfolioRequest $request
     * @return void
     */
    private function createJobSeekerPortfolio(PortfolioRequest $request): void
    {
        // Store the uploaded resume file in the 'resumes' directory
        $resumePath = $request->file('resume')->store('resumes', 'public');

        // Create a new job seeker portfolio using the relationship
        auth()->user()
            ->jobSeeker()
            ->create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'resume' => $resumePath,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
    }

    /**
     * Update the job seeker's portfolio.
     *
     * @param PortfolioRequest $request
     * @param JobSeeker $portfolio
     * @return void
     */
    private function updateJobSeekerPortfolio(PortfolioRequest $request, JobSeeker $portfolio): void
    {
        // Initialize resume path with the current resume
        $resumePath = $portfolio->resume;

        // Check if a new resume is uploaded
        if ($request->hasFile('resume')) {
            // Delete the old resume if it exists
            if ($portfolio->resume) {
                Storage::delete($portfolio->resume);
            }

            // Store the new resume file
            $resumePath = $request->file('resume')->store('resumes', 'public');
        }

        // Update the job seeker's portfolio with new data
        $portfolio->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'resume' => $resumePath,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
    }
}
