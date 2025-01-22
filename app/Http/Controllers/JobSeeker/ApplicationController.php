<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the job seeker's applications.
     *
     * @return View
     */
    public function index(): View
    {
        // Retrieve applications for the authenticated job seeker
        $applications = $this->getJobSeekerApplications();

        // Return the view with the list of applications
        return view('job-seeker.application.index', compact('applications'));
    }

    /**
     * Get the job seeker's applications with related job listings and companies.
     *
     * @return Collection
     */
    private function getJobSeekerApplications() : Collection
    {
        if(auth()->user()->jobSeeker){
            // Fetch the authenticated job seeker's applications, including related job listings and companies
            return auth()->user()->jobSeeker->applications()->with('jobsListing.company')->latest()->get();
        }

        return new Collection();
    }
}
