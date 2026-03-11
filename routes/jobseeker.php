<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;

Route::middleware(['auth', 'role:job_seeker'])
    ->prefix('jobseeker')
    ->name('jobseeker.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', function () {
            $user = auth()->user();
            if (!$user->profile) {
                return redirect()->route('jobseeker.profile.create')
                    ->with('info', 'Please complete your profile first.');
            }
            return view('dashboards.jobseeker');
        })->name('dashboard');

        // Profile
        Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
        Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

        // Jobs
        Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
        Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
        Route::get('/jobs/{job}/apply', [JobController::class, 'applyForm'])->name('jobs.apply.form')->middleware('auth');
        Route::post('/jobs/{job}/apply', [ApplicationController::class, 'apply'])->name('jobs.apply.submit')->middleware('auth');


        // Applications
        Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
        Route::get('/applications/{application}', [ApplicationController::class, 'show'])->name('applications.show');
    });