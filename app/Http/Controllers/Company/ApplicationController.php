<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\JobSeeker;

class ApplicationController extends Controller
{
    /**
     * Display a listing of applications submitted for the company's job listings.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        // Fetch the company of the authenticated user
        $company = auth()->user()->company;

        // Use the method from the Company model to get all applications
        $applications = $company->getAllApplications();

        // Return the view with the list of applications
        return view('company.application.index', compact('applications'));
    }

    /**
     * Display the specified applicant's details.
     *
     * @param  \App\Models\JobSeeker  $applicant
     * @return \Illuminate\View\View
     */
    public function applicant(JobSeeker $applicant): View
    {
        // Return the view for the specific applicant's details
        return view('company.application.applicant', compact('applicant'));
    }
}
