<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlacesController;
use App\Http\Controllers\ProfileController as BPC;

// Company
use App\Http\Controllers\Company\ProfileController as CompanyProfileController;
use App\Http\Controllers\Company\JobController as CompanyJobController;
use App\Http\Controllers\Company\ApplicationController as CompanyApplicationController;
use App\Http\Controllers\Company\DashboardController as CompanyDashboardController;

// JOb Seeker
use App\Http\Controllers\JobSeeker\DashboardController as JobSeekerDashboardController;
use App\Http\Controllers\JobSeeker\PortfolioController;
use App\Http\Controllers\JobSeeker\ApplicationController as JobSeekerApplicationController;

// Public
Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/job/{job}', [HomeController::class, 'showJob'])->name('job');

Route::get('/find-jobs', [HomeController::class, 'findJobs'])->name('find.jobs');

Route::get('/filter-jobs', [HomeController::class, 'filterJobs'])->name('filter.jobs');


Route::get('/places', [PlacesController::class, 'index'])->name('places');


// Auth
require __DIR__ . '/auth.php';


Route::middleware(['auth', 'verified'])->group(function () {
    //Admin
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });

    // Company
    Route::prefix('company')->group(function () {
        // Dashboard
        Route::get('/dashboard', [CompanyDashboardController::class, 'index'])->name('company.dashboard');

        // profile
        Route::get('/profile', [CompanyProfileController::class, 'index'])->name('company.profile');

        Route::get('/create', [CompanyProfileController::class, 'create'])->name('company.profile.create');
        Route::post('/company', [CompanyProfileController::class, 'store'])->name('company.profile.store');

        Route::get('/{company}/edit', [CompanyProfileController::class, 'edit'])->name('company.profile.edit');
        Route::put('/{company}', [CompanyProfileController::class, 'update'])->name('company.profile.update');

        // Setting
        Route::get('/profile/brezee', [BPC::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [BPC::class, 'update'])->name('profile.update');
        Route::delete('/profile', [BPC::class, 'destroy'])->name('profile.destroy');

        // Jobs
        Route::get('/jobs', [CompanyJobController::class, 'index'])->name('jobs');
        Route::get('/show/{job}', [CompanyJobController::class, 'show'])->name('job.show');

        Route::get('job/create', [CompanyJobController::class, 'create'])->name('job.create');
        Route::post('/job', [CompanyJobController::class, 'store'])->name('job.store');

        Route::get('/job/{job}/edit', [CompanyJobController::class, 'edit'])->name('job.edit');
        Route::put('/job/{job}', [CompanyJobController::class, 'update'])->name('job.update');

        Route::delete('/job/{job}', [CompanyJobController::class, 'destroy'])->name('job.destroy');

        // Application
        Route::get('/applications', [CompanyApplicationController::class, 'index'])->name('applications');
        Route::get('/application/{application}/change/status', [CompanyApplicationController::class, 'changeStatus'])->name('application.status.change');
        Route::get('/application/{applicant}', [CompanyApplicationController::class, 'applicant'])->name('applicant.portfolio');
    });

    // Job Seeker
    Route::prefix('job-seeker')->group(function () {
        // Dashboard
        Route::get('/dashboard', [JobSeekerDashboardController::class, 'index'])->name('job-seeker.dashboard');

        // Portfolio
        Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');

        Route::get('/portfolio/create', [PortfolioController::class, 'create'])->name('portfolio.create');
        Route::post('/portfolio', [PortfolioController::class, 'store'])->name('portfolio.store');

        Route::get('/portfolio/{portfolio}/edit', [PortfolioController::class, 'edit'])->name('portfolio.edit');
        Route::put('/portfolio/{portfolio}', [PortfolioController::class, 'update'])->name('portfolio.update');

        // Apply for job
        Route::post('/apply/{job}', [HomeController::class, 'applyForJob'])->name('apply.job');

        Route::get('/applications', [JobSeekerApplicationController::class, 'index'])->name('job-seeker.applications');
    });
});
