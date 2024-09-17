<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use App\Models\JobSeeker;
use App\Models\Application;

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
     * Update the status of a job application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus(Request $request, Application $application): JsonResponse
    {
        // Validate the incoming request to ensure the status is present and within the allowed values
        $request->validate([
            'status' => 'required|in:applied,reviewed,interviewed,hired,rejected', // Only accept predefined status values
        ]);

        // Update the application's status with the one provided in the request
        $application->status = $request->status;

        // Save the updated status to the database
        $application->save();

        // Return a JSON response indicating the status change was successful, with a success message
        return response()->json(['success' => true, 'message' => 'Application status updated successfully']);
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
