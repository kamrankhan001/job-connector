<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CompanyProfileRequest;
use App\Models\Company;

class ProfileController extends Controller
{
    /**
     * Display the company profile.
     *
     * @return View
     */
    public function index(): View
    {
        // Retrieve the company associated with the authenticated user
        $company = auth()->user()->company;

        // Return the company profile view with the retrieved company data
        return view('company.profile.index', compact('company'));
    }

    /**
     * Show the form for creating a new company profile.
     *
     * @return View
     */
    public function create(): View
    {
        // Return the view to create a new company profile
        return view('company.profile.create');
    }

    /**
     * Store a newly created company profile in storage.
     *
     * @param  CompanyProfileRequest  $request
     * @return RedirectResponse
     */
    public function store(CompanyProfileRequest $request): RedirectResponse
    {
        // Validate the request data
        $profile = $request->validated();

        // Create a new company profile using the model's method
        Company::createProfile(auth()->user()->id(), $profile);

        // Redirect to the company profile route with a success message
        return redirect()->route('company.profile')
            ->with('success', 'Your profile has been created successfully. Now you can post jobs.');
    }

    /**
     * Show the form for editing the specified company profile.
     *
     * @param  Company  $company
     * @return View
     */
    public function edit(Company $company): View
    {
        // Return the view to edit the specified company profile
        return view('company.profile.edit', compact('company'));
    }

    /**
     * Update the specified company profile in storage.
     *
     * @param  CompanyProfileRequest  $request
     * @param  Company  $company
     * @return RedirectResponse
     */
    public function update(CompanyProfileRequest $request, Company $company): RedirectResponse
    {
        // Validate the request data
        $profile = $request->validated();

        // Update the company profile using the model's method
        $company->updateProfile($profile);

        // Redirect to the company profile route with a success message
        return redirect()->route('company.profile')
            ->with('success', 'Your profile has been updated successfully.');
    }
}
