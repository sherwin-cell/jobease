<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\Employer\DashboardController;

/*
|--------------------------------------------------------------------------
| Employer Routes
|--------------------------------------------------------------------------
*/

// ==================== PROFILE ROUTES (Accessible even if profile incomplete) ====================
Route::middleware(['auth', 'role:employer', 'verified'])
    ->prefix('employer')
    ->name('employer.')
    ->group(function () {

        // Profile completion page
        Route::get('/profile/complete', function () {
            $user = auth()->user();
            if ($user->employerProfile && $user->employerProfile->is_complete) {
                if ($user->employerProfile->approval_status === 'pending') {
                    return redirect()->route('employer.profile-pending');
                }
                if ($user->employerProfile->approval_status === 'approved') {
                    return redirect()->route('employer.dashboard');
                }
                if ($user->employerProfile->approval_status === 'rejected') {
                    $company = $user->employerProfile;
                    return view('employer.complete-profile', compact('company'))
                        ->with('error', 'Your profile was rejected. Please update and resubmit.');
                }
            }
            $company = $user->employerProfile ?? new \App\Models\EmployerProfile(['user_id' => $user->id]);
            return view('employer.complete-profile', compact('company'));
        })->name('complete-profile');

        // Profile edit
        Route::get('/profile/edit', [EmployerController::class, 'editProfile'])->name('profile.edit');
        Route::put('/profile', [EmployerController::class, 'updateProfile'])->name('profile.update');

        // Profile pending approval page
        Route::get('/profile/pending', function () {
            return view('employer.profile-pending');
        })->name('profile-pending');
    });

// ==================== FULL ACCESS ROUTES (Requires complete & approved profile) ====================
// REMOVED 'employer.profile.approved' - it's already handled by 'employer.profile.complete'
Route::middleware(['auth', 'role:employer', 'verified', 'employer.profile.complete'])
    ->prefix('employer')
    ->name('employer.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Jobs Management
        Route::get('/jobs', [JobController::class, 'employerIndex'])->name('jobs.index');
        Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
        Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
        Route::get('/jobs/{job}', [JobController::class, 'employerShow'])->name('jobs.show');
        Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
        Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
        Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');

        // Applications Management
        Route::get('/applications', [ApplicationController::class, 'employerIndex'])->name('applications.index');
        Route::get('/applications/{application}', [ApplicationController::class, 'employerShow'])->name('applications.show');
        Route::put('/applications/{application}/status', [ApplicationController::class, 'updateStatus'])->name('applications.updateStatus');
        Route::put('/applications/{application}/skill-review', [ApplicationController::class, 'updateSkillReview'])->name('applications.updateSkillReview');

        // Interview Management
        Route::post('/applications/{application}/schedule-interview', [ApplicationController::class, 'scheduleInterview'])->name('interviews.schedule');
        Route::get('/applications/{application}/schedule-interview-form', [ApplicationController::class, 'showScheduleInterviewForm'])->name('interviews.schedule.form');
    });