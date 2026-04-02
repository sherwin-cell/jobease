<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminJobController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminDashboardController;

Route::middleware(['auth', 'role:3']) // 3 = Super Admin
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Users management
        Route::get('/users', [AdminUserController::class, 'index'])->name('users');
        Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
        Route::post('/users/{user}/ban', [AdminUserController::class, 'ban'])->name('users.ban');
        Route::post('/users/{user}/unban', [AdminUserController::class, 'unban'])->name('users.unban');

        // Jobs management
        Route::get('/jobs', [AdminJobController::class, 'index'])->name('jobs');

        // Reports
        Route::get('/reports', [AdminReportController::class, 'index'])->name('reports');
    });