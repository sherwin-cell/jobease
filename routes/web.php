<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\InterviewSessionController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\EmployerRegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('employer/register', [EmployerRegisterController::class, 'showRegistrationForm'])->name('employer.register');
Route::post('employer/register', [EmployerRegisterController::class, 'register']);

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth'])->group(function () {

    // Employer
    Route::get('/employer/interviews', [InterviewSessionController::class, 'employerIndex'])
        ->name('employer.interviews');

    Route::post('/interviews', [InterviewSessionController::class, 'store'])
        ->name('interviews.store');

    Route::post('/interviews/{id}/start', [InterviewSessionController::class, 'start'])
        ->name('interviews.start');

    Route::get('/applications/{application}/schedule-interview', [ApplicationController::class, 'showScheduleInterviewForm'])
        ->name('employer.interviews.schedule.form');

    Route::post('/applications/{application}/schedule-interview', [ApplicationController::class, 'scheduleInterview'])
        ->name('employer.interviews.schedule');

    // Job Seeker
    Route::get('/jobseeker/interviews', [InterviewSessionController::class, 'jobSeekerIndex'])
        ->name('jobseeker.interviews');

    // Join Call
    Route::get('/interviews/{id}/join', [InterviewSessionController::class, 'join'])
        ->name('interviews.join');

    Route::get('/interviews/call/{session}', [InterviewSessionController::class, 'call'])->name('interviews.call');

    // Email Verification Routes
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route(auth()->user()->dashboardRoute());
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});

