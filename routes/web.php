<?php

use App\Http\Controllers\ProfileController as BPC;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutocompleteController;
use App\Http\Controllers\Company\ProfileController;


Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/autocomplete/location', [AutocompleteController::class, 'locations'])->name('autocomplete.locations');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('company.profile');

    Route::get('/profile/create', [ProfileController::class, 'create'])->name('company.profile.create');

    Route::get('/profile/{company}/edit', [ProfileController::class, 'edit'])->name('company.profile.edit');

    Route::get('/profile/brezee', [BPC::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [BPC::class, 'update'])->name('profile.update');
    Route::delete('/profile', [BPC::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
