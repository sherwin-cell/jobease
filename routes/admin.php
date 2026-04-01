<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Point to controller instead of using closure
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');
    });