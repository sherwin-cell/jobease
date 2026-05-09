<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminJobController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminEmployerProfileController;

Route::middleware(['auth', 'role:3']) // 3 = Super Admin
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Employer Profiles management
        Route::get('/employer-profiles', [AdminEmployerProfileController::class, 'index'])->name('employer-profiles.index');
        Route::get('/employer-profiles/{employerProfile}', [AdminEmployerProfileController::class, 'show'])->name('employer-profiles.show');
        Route::post('/employer-profiles/{employerProfile}/approve', [AdminEmployerProfileController::class, 'approve'])->name('employer-profiles.approve');
        Route::post('/employer-profiles/{employerProfile}/reject', [AdminEmployerProfileController::class, 'reject'])->name('employer-profiles.reject');
        Route::post('/employer-profiles/{employerProfile}/reset', [AdminEmployerProfileController::class, 'resetStatus'])->name('employer-profiles.reset');

        // Users management
        Route::get('/users', [AdminUserController::class, 'index'])->name('users');
        Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
        Route::post('/users/{user}/ban', [AdminUserController::class, 'ban'])->name('users.ban');
        Route::post('/users/{user}/unban', [AdminUserController::class, 'unban'])->name('users.unban');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

        // ========== JOBS MANAGEMENT - NO EDIT ==========
        // List all jobs
        Route::get('/jobs', [AdminJobController::class, 'index'])->name('jobs.index');
        
        // View single job
        Route::get('/jobs/{job}', [AdminJobController::class, 'show'])->name('jobs.show');
        
        // Delete job
        Route::delete('/jobs/{job}', [AdminJobController::class, 'destroy'])->name('jobs.destroy');
        
        // Approve job
        Route::post('/jobs/{job}/approve', [AdminJobController::class, 'approve'])->name('jobs.approve');
        
        // Reject job
        Route::post('/jobs/{job}/reject', [AdminJobController::class, 'reject'])->name('jobs.reject');
        
        // Close job
        Route::post('/jobs/{job}/close', [AdminJobController::class, 'close'])->name('jobs.close');
        
        // Bulk actions
        Route::post('/jobs/bulk-action', [AdminJobController::class, 'bulkAction'])->name('jobs.bulk-action');

        // Activity Logs
        Route::get('/activity-logs', function () {
            $logs = \App\Models\ActivityLog::with('user')->latest()->paginate(9);
            return view('admin.activity-logs.index', compact('logs'));
        })->name('activity-logs');

        Route::post('/activity-logs/cleanup', [AdminDashboardController::class, 'cleanupOrphanedLogs'])
            ->name('activity-logs.cleanup');
    
        // Profile routes
        Route::middleware(['auth'])->group(function () {
            Route::get('/profile/settings', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.settings');
            Route::put('/profile/settings', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
        });
    });