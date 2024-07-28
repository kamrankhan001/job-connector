<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CompanyProfileRequest;
use Illuminate\Http\Request;
use App\Models\Company;

class ProfileController extends Controller
{
    public function index(): View
    {
        $company = Company::where('user_id', auth()->user()->id)->first();
        return view('company.profile.index', compact('company'));
    }

    public function create(): View
    {
        return view('company.profile.create');
    }

    public function store(CompanyProfileRequest $request): RedirectResponse
    {
        $profile = $request->validated();

        Company::create([
            'user_id' => auth()->id(),
            'company_name' => $profile['name'],
            'phone' => $profile['phone'],
            'website' => $profile['website'],
            'address' => $profile['address'],
        ]);

        return redirect()->route('company.profile')->with('success', 'Your profile has been created successfully. Now you can post jobs.');
    }

    public function edit(Company $company): View
    {
        return view('company.profile.edit', compact('company'));
    }

    public function update(CompanyProfileRequest $request, Company $company): RedirectResponse
    {
        $profile = $request->validated();

        $company->update([
            'company_name' => $profile['name'],
            'phone' => $profile['phone'],
            'website' => $profile['website'],
            'address' => $profile['address'],
        ]);

        return redirect()->route('company.profile')->with('success', 'Your profile has been updated successfully.');
    }
}
