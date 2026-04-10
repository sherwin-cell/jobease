<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\EmployerLiveSkillQaController;
use App\Http\Controllers\LiveSkillQaCallController;

Route::middleware(['auth', 'role:employer'])
    ->prefix('employer')
    ->name('employer.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', function () {
            return view('dashboards.employer');
        })->name('dashboard');

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

        // Live Skill Q&A sessions
        Route::get('/live-skill-qa', [EmployerLiveSkillQaController::class, 'index'])->name('live-skill-qa.index');
        Route::get('/live-skill-qa/jobs/{job}', [EmployerLiveSkillQaController::class, 'show'])->name('live-skill-qa.show');
        Route::post('/live-skill-qa/jobs/{job}/start', [LiveSkillQaCallController::class, 'employerStart'])->name('live-skill-qa.start');
        Route::get('/live-skill-qa/sessions/{session}/call', [LiveSkillQaCallController::class, 'employerCall'])->name('live-skill-qa.call');
    });