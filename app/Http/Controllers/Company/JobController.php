<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\JobListingRequest;
use Illuminate\Http\Request;
use App\Models\JobsListing;
use App\Models\Company;

class JobController extends Controller
{
    public function index(): View
    {
        $company = Company::where('user_id', auth()->user()->id)->first();
        $jobs = JobsListing::where('company_id', $company->id)
            ->latest()
            ->paginate(10);

        return view('company.job.index', compact('jobs'));
    }

    public function show(JobsListing $job): View
    {
        return view('company.job.view', compact('job'));
    }

    public function create(): View
    {
        return view('company.job.create');
    }

    public function store(JobListingRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        JobsListing::create([
            'company_id' => auth()->user()->id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'requirements' => $validated['requirements'],
            'location' => $validated['location'],
            'salary' => $validated['salary'],
            'job_type' => $validated['job_type'],
        ]);

        return redirect()->route('jobs')->with('success', 'Job listing created successfully!');
    }

    public function edit(JobsListing $job): View
    {
        return view('company.job.edit', compact('job'));
    }

    public function update(JobListingRequest $request, JobsListing $job): RedirectResponse
    {
        $validated = $request->validated();

        $job->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'requirements' => $validated['requirements'],
            'location' => $validated['location'],
            'salary' => $validated['salary'],
            'job_type' => $validated['job_type'],
        ]);

        return redirect()->route('jobs')->with('success', 'Job updated successfully!');
    }

    public function destroy(JobsListing $job): RedirectResponse
    {
        $job->delete();

        return redirect()->route('jobs')->with('success', 'Job deleted successfully!');
    }
}
