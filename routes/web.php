<?php

use App\Http\Controllers\ProfileController as BPC;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AutocompleteController;
use App\Http\Controllers\Company\ProfileController;
use App\Http\Controllers\Company\JobController;
use App\Http\Controllers\Company\ApplicationController;

// JOb Seeker
use App\Http\Controllers\JobSeeker\DashboardController as JobSeekerDashboardController;
use App\Http\Controllers\JobSeeker\PortfolioController;
use App\Http\Controllers\JobSeeker\ApplicationController as JobSeekerApplicationController;



Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/job/{job}', [HomeController::class, 'show'])->name('job');


Route::get('/autocomplete/location', [AutocompleteController::class, 'locations'])->name('autocomplete.locations');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/company/profile', [ProfileController::class, 'index'])->name('company.profile');

    Route::get('/company/create', [ProfileController::class, 'create'])->name('company.profile.create');
    Route::post('/company', [ProfileController::class, 'store'])->name('company.profile.store');

    Route::get('/company/{company}/edit', [ProfileController::class, 'edit'])->name('company.profile.edit');
    Route::put('/company/{company}', [ProfileController::class, 'update'])->name('company.profile.update');

    Route::get('/profile/brezee', [BPC::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [BPC::class, 'update'])->name('profile.update');
    Route::delete('/profile', [BPC::class, 'destroy'])->name('profile.destroy');

    Route::get('/jobs', [JobController::class, 'index'])->name('jobs');
    Route::get('/show/{job}', [JobController::class, 'show'])->name('job.show');

    Route::get('/job/create', [JobController::class, 'create'])->name('job.create');
    Route::post('/job', [JobController::class, 'store'])->name('job.store');

    Route::get('/job/{job}/edit', [JobController::class, 'edit'])->name('job.edit');
    Route::put('/job/{job}', [JobController::class, 'update'])->name('job.update');

    Route::delete('/job/{job}', [JobController::class, 'destroy'])->name('job.destroy');

    Route::get('/Applications', [ApplicationController::class, 'index'])->name('applications');


    // Job Seeker
    Route::get('/job-seeker/dashboard', [JobSeekerDashboardController::class, 'index'])->name('job-seeker.dashboard');

    Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');

    Route::get('/portfolio/create', [PortfolioController::class, 'create'])->name('portfolio.create');
    Route::post('/portfolio', [PortfolioController::class, 'store'])->name('portfolio.store');

    Route::get('/portfolio/{portfolio}/edit', [PortfolioController::class, 'edit'])->name('portfolio.edit');
    Route::put('/portfolio/{portfolio}', [PortfolioController::class, 'update'])->name('portfolio.update');


    // Apply for job
    Route::post('/apply/{job}', [HomeController::class, 'apply'])->name('apply.job');

    Route::get('/applications', [JobSeekerApplicationController::class, 'index'])->name('job-seeker.applications');



});

require __DIR__.'/auth.php';
