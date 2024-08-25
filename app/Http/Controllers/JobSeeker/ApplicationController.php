<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Application;

class ApplicationController extends Controller
{
    public function index(): View
    {
        $applications = auth()->user()->jobSeeker->applications()->with('jobsListing.company')->latest()->get();

        return view('job-seeker.application.index', compact('applications'));
    }
}
