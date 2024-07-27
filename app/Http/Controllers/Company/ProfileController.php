<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index() : View
    {
        return view('company.profile.index');
    }

    public function create() : View
    {
        return view('company.profile.create');
    }

    public function edit(Company $company) : View
    {
        return view('company.profile.edit', compact('company'));
    }
}
