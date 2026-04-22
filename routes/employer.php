<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\EmployerController;

Route::middleware(['auth', 'role:employer', 'verified'])
    ->prefix('employer')
    ->name('employer.')
    ->group(function () {

        // Profile completion (accessible even if profile incomplete)
        Route::get('/profile/complete', function () {
            $user = auth()->user();
            // If profile exists and is complete, redirect to dashboard
            if ($user->employerProfile && $user->employerProfile->is_complete) {
                return redirect()->route('employer.dashboard');
            }
            $company = $user->employerProfile ?? new \App\Models\EmployerProfile(['user_id' => $user->id]);
            return view('employer.complete-profile', compact('company'));
        })->name('complete-profile');

        // Profile edit (accessible even if profile incomplete)
        Route::get('/profile/edit', [EmployerController::class, 'editProfile'])->name('profile.edit');
        Route::put('/profile', [EmployerController::class, 'updateProfile'])->name('profile.update');

        // Profile pending approval (accessible even if profile not approved)
        Route::get('/profile/pending', function () {
            return view('employer.profile-pending');
        })->name('profile-pending');
    });

Route::middleware(['auth', 'role:employer', 'verified', 'employer.profile.complete'])
    ->prefix('employer')
    ->name('employer.')
    ->group(function () {

        // Dashboard (NOW FULLY PROTECTED)
        Route::get('/dashboard', [EmployerController::class, 'dashboard'])
            ->name('dashboard');

        // Jobs
        Route::get('/jobs', [JobController::class, 'employerIndex'])->name('jobs.index');
        Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
        Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
        Route::get('/jobs/{job}', [JobController::class, 'employerShow'])->name('jobs.show');
        Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
        Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
        Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');

        // Applications
        Route::get('/applications', [ApplicationController::class, 'employerIndex'])->name('applications.index');
        Route::get('/applications/{application}', [ApplicationController::class, 'employerShow'])->name('applications.show');
        Route::post('/applications/{application}/status', [ApplicationController::class, 'updateStatus'])->name('applications.updateStatus');
        Route::post('/applications/{application}/schedule-interview', [ApplicationController::class, 'scheduleInterview'])->name('interviews.schedule');


        // Dashboard
        Route::get('/dashboard', [EmployerController::class, 'dashboard'])->name('dashboard');

    });