<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\InterviewSessionController;
use App\Http\Controllers\JobseekerProfileController;
use App\Http\Controllers\JobSeeker\DashboardController;

// Routes that require verified email
Route::middleware(['auth', 'role:job_seeker', 'verified'])
    ->prefix('jobseeker')
    ->name('jobseeker.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Profile
        Route::get('/profile/create', [JobseekerProfileController::class, 'create'])->name('profile.create');
        Route::post('/profile', [JobseekerProfileController::class, 'store'])->name('profile.store');
        Route::get('/profile', [JobseekerProfileController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [JobseekerProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [JobseekerProfileController::class, 'update'])->name('profile.update');

        // Jobs
        Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
        Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
        Route::get('/jobs/{job}/apply', [JobController::class, 'applyForm'])->name('jobs.apply.form');
        Route::post('/jobs/{job}/apply', [ApplicationController::class, 'apply'])->name('jobs.apply.submit');

        // Applications
        Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
        Route::get('/applications/{application}', [ApplicationController::class, 'show'])->name('applications.show');

        // Interviews
        Route::get('/interviews/{session}/join', [InterviewSessionController::class, 'join'])->name('interviews.join');
    });