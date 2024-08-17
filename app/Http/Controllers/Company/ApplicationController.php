<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Company;
use App\Models\Application;

class ApplicationController extends Controller
{
    public function index(): View
    {
        $company = Company::where('user_id', auth()->user()->id)->first();

        // Retrieve all job listings for the company
        $jobIds = $company->jobsListing->pluck('id');

        // Retrieve applications for those jobs
        $applications = Application::whereIn('jobs_listings_id', $jobIds)->get();

        return view('company.application.index', compact('applications'));
    }
}
