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
use Illuminate\Support\Facades\DB; // Add this line

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==================== PUBLIC ROUTES ====================
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Terms and Privacy (public, no login required)
Route::view('/terms', 'legal.terms')->name('terms');
Route::view('/privacy', 'legal.privacy')->name('privacy');

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
    // ==================== JOB SEEKER ROUTES ====================
    Route::middleware(['role:job_seeker'])
        ->prefix('jobseeker')
        ->name('jobseeker.')
        ->group(function () {
            // Job Seeker dashboard
            Route::get('/dashboard', function () {
                return view('jobseeker.dashboard');
            })->name('dashboard');
    
            // Interview routes
            Route::get('/interviews', [InterviewSessionController::class, 'jobSeekerIndex'])->name('interviews');

            // Add other job seeker routes here
            // Route::get('/jobs', [JobController::class, 'browse'])->name('jobs');
            // Route::get('/applications', [ApplicationController::class, 'myApplications'])->name('applications');
        });

    // ==================== SHARED AUTHENTICATED ROUTES ====================
    Route::post('/interviews', [InterviewSessionController::class, 'store'])->name('interviews.store');
    Route::post('/interviews/{id}/start', [InterviewSessionController::class, 'start'])->name('interviews.start');
    Route::get('/interviews/{id}/join', [InterviewSessionController::class, 'join'])->name('interviews.join');
    Route::get('/interviews/call/{session}', [InterviewSessionController::class, 'call'])->name('interviews.call');

    // Application routes
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

// ==================== DEBUG ROUTES ====================

// Debug 1: Check queue jobs
Route::get('/debug/queue', function () {
    try {
        $jobsCount = DB::table('jobs')->count();
        $failedJobsCount = DB::table('failed_jobs')->count();
        
        return [
            'status' => 'success',
            'queue_connection' => config('queue.default'),
            'pending_jobs' => $jobsCount,
            'failed_jobs' => $failedJobsCount,
            'message' => $jobsCount > 0 ? "There are {$jobsCount} pending jobs in queue!" : "Queue is empty",
        ];
    } catch (\Exception $e) {
        return ['status' => 'error', 'message' => $e->getMessage()];
    }
});

// Debug 2: Test email sending
Route::get('/debug/email/{email}', function ($email) {
    try {
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            return ['status' => 'error', 'message' => "User with email {$email} not found"];
        }
        
        // Check if user implements MustVerifyEmail
        $implements = in_array('Illuminate\Contracts\Auth\MustVerifyEmail', class_implements($user));
        
        // Send verification email
        $user->sendEmailVerificationNotification();
        
        return [
            'status' => 'success',
            'email' => $user->email,
            'user_id' => $user->id,
            'role' => $user->isJobSeeker() ? 'job_seeker' : ($user->isEmployer() ? 'employer' : 'other'),
            'implements_must_verify_email' => $implements,
            'message' => "Verification email sent to {$user->email}"
        ];
    } catch (\Exception $e) {
        return ['status' => 'error', 'message' => $e->getMessage(), 'trace' => $e->getTraceAsString()];
    }
});

// Debug 3: Check mail configuration
Route::get('/debug/mail', function () {
    return [
        'default_mailer' => config('mail.default'),
        'mailers_available' => array_keys(config('mail.mailers', [])),
        'from_address' => config('mail.from.address'),
        'from_name' => config('mail.from.name'),
        'resend_configured' => !empty(env('RESEND_API_KEY')),
    ];
});

// Original test route
Route::get('/create-log', function () {
    try {
        DB::table('activity_log')->insert([
            'log_name' => 'default',
            'description' => 'Test log from web route',
            'causer_id' => auth()->id() ?? 1,
            'properties' => json_encode(['action' => 'Web Test']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return '✅ Log created successfully! <a href="/admin/dashboard">Go to Admin Dashboard</a>';
    } catch (Exception $e) {
        return '❌ Error: ' . $e->getMessage();
    }
});