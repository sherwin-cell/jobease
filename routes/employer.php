<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\EmployerController;

Route::middleware(['auth', 'role:employer', 'verified'])
    ->prefix('employer')
    ->name('employer.')
    ->group(function () {


        // Profile
        Route::get('/profile/edit', [EmployerController::class, 'editProfile'])->name('profile.edit');
        Route::put('/profile', [EmployerController::class, 'updateProfile'])->name('profile.update');

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
        Route::post('/applications/{application}/schedule-interview', [ApplicationController::class, 'scheduleInterview'])->name('employer.interviews.schedule');

        // Dashboard
        Route::get('/dashboard', [EmployerController::class, 'dashboard'])->name('dashboard');

    });