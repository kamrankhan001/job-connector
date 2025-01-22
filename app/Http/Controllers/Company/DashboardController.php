<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Application;

class DashboardController extends Controller
{
    /**
     * Display the company dashboard with application statistics.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        // Get the authenticated user's company
        $company = auth()->user()->company;

        if($company) {
            // Retrieve application statistics using the Application model
            $totalApplication = Application::totalApplicationsByCompany($company);
            $totalApproved = Application::approvedApplicationsByCompany($company);
            $totalRejected = Application::rejectedApplicationsByCompany($company);

        }else{
            $totalApplication = null;
            $totalApproved = null;
            $totalRejected = null;
        }

        // Fetch unread notifications
        $notifications = auth()->user()->unreadNotifications;

        // Pass the data to the company dashboard view
        return view('company.dashboard', compact('totalApplication', 'totalApproved', 'totalRejected', 'notifications'));
    }
}
