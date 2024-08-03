<?php

use App\Http\Controllers\ProfileController as BPC;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutocompleteController;
use App\Http\Controllers\Company\ProfileController;
use App\Http\Controllers\Company\JobController;


Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/autocomplete/location', [AutocompleteController::class, 'locations'])->name('autocomplete.locations');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/company/profile', [ProfileController::class, 'index'])->name('company.profile');

    Route::get('/company/profile/create', [ProfileController::class, 'create'])->name('company.profile.create');
    Route::post('/company/profile/', [ProfileController::class, 'store'])->name('company.profile.store');

    Route::get('/company/profile/{company}/edit', [ProfileController::class, 'edit'])->name('company.profile.edit');
    Route::put('/company/profile/{company}', [ProfileController::class, 'update'])->name('company.profile.update');

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



});

require __DIR__.'/auth.php';
