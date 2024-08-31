<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\JobSeeker;
use App\Models\Application;


class ApplicationController extends Controller
{
    public function index(): View
    {
        $jobListings = auth()->user()->company->jobsListing()->pluck('id');

        $applications = Application::whereIn('jobs_listings_id', $jobListings)
            ->with('jobsListing', 'jobSeeker')
            ->get();

        return view('company.application.index', compact('applications'));
    }

    public function applicant(JobSeeker $applicant): View
    {
        return view('company.application.applicant', compact('applicant'));
    }
}
