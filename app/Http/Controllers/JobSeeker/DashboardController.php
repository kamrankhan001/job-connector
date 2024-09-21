<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    public function index(): View
    {
        $pendingApplications =  auth()->user()->jobSeeker->applications()->where('status', 'applied')->count();
        $progressApplications =  auth()->user()->jobSeeker->applications()->where('status', 'reviewed')->count();
        $acceptedApplications =  auth()->user()->jobSeeker->applications()->where('status', 'interviewed')->count();
        $rejectedApplications =  auth()->user()->jobSeeker->applications()->where('status', 'rejected')->count();


        return view('job-seeker.dashboard', compact('pendingApplications','progressApplications','acceptedApplications','rejectedApplications'));
    }
}
