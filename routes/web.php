<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\InterviewSessionController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\EmployerRegisterController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==================== PUBLIC ROUTES ====================
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ==================== REGISTRATION ROUTES ====================
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('employer/register', [EmployerRegisterController::class, 'showRegistrationForm'])->name('employer.register');
Route::post('employer/register', [EmployerRegisterController::class, 'register']);

// ==================== LOGIN ROUTES ====================
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// ==================== EMAIL VERIFICATION ROUTES ====================

// Show verification notice
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Handle verification - Auto-login
Route::get('/email/verify/{id}/{hash}', function ($id, $hash) {
    $user = User::findOrFail($id);
    $expectedHash = sha1($user->getEmailForVerification());

    if (!hash_equals((string) $hash, $expectedHash)) {
        return redirect('/login')->with('error', 'Invalid verification link.');
    }

    if ($user->hasVerifiedEmail()) {
        return redirect('/login')->with('info', 'Email already verified.');
    }

    $user->markEmailAsVerified();
    Auth::login($user);

    if ($user->isJobSeeker()) {
        $profile = $user->jobseekerProfile;
        $needsCompletion = !$profile || empty($profile->headline);

        if ($needsCompletion) {
            return redirect()->route('jobseeker.profile.edit')
                ->with('success', 'Email verified! Please complete your profile.');
        }
        return redirect()->route('jobseeker.dashboard')
            ->with('success', 'Email verified successfully!');
    }

    if ($user->isEmployer()) {
        if (!$user->employerProfile || !$user->employerProfile->is_complete) {
            return redirect()->route('employer.complete-profile')
                ->with('success', 'Email verified! Please complete your company profile.');
        }
        return redirect()->route('employer.dashboard')
            ->with('success', 'Email verified successfully!');
    }

    return redirect('/dashboard');
})->name('verification.verify');

// Resend verification email
Route::post('/email/verification-notification', function (Request $request) {
    $user = $request->user();

    if ($user->hasVerifiedEmail()) {
        return redirect('/login')->with('info', 'Email already verified.');
    }

    $user->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// ==================== AUTHENTICATED ROUTES ====================
Route::middleware(['auth'])->group(function () {

    // ==================== INTERVIEW ROUTES ====================
    Route::prefix('employer')->name('employer.')->group(function () {
        Route::get('/interviews', [InterviewSessionController::class, 'employerIndex'])->name('interviews');
    });

    Route::prefix('jobseeker')->name('jobseeker.')->group(function () {
        Route::get('/interviews', [InterviewSessionController::class, 'jobSeekerIndex'])->name('interviews');
    });

    Route::post('/interviews', [InterviewSessionController::class, 'store'])->name('interviews.store');
    Route::post('/interviews/{id}/start', [InterviewSessionController::class, 'start'])->name('interviews.start');
    Route::get('/interviews/{id}/join', [InterviewSessionController::class, 'join'])->name('interviews.join');
    Route::get('/interviews/call/{session}', [InterviewSessionController::class, 'call'])->name('interviews.call');

    // ==================== APPLICATION ROUTES ====================
    Route::get('/applications/{application}/schedule-interview', [ApplicationController::class, 'showScheduleInterviewForm'])->name('employer.interviews.schedule.form');
    Route::post('/applications/{application}/schedule-interview', [ApplicationController::class, 'scheduleInterview'])->name('employer.interviews.schedule');

    // ==================== INCLUDE MODULE ROUTES ====================
    require __DIR__ . '/admin.php';
    require __DIR__ . '/employer.php';
    require __DIR__ . '/jobseeker.php';
});

// ==================== FALLBACK ROUTE ====================
Route::fallback(function () {
    return redirect()->route('home');
});