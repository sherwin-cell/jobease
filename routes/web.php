<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\EmployerRegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\CandidateController;

// ---------- Public Routes ----------
// Public routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('register/employer', [EmployerRegisterController::class, 'showRegistrationForm'])->name('register.employer');
Route::post('register/employer', [EmployerRegisterController::class, 'register']);

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// ---------- Role-Based Dashboards ---------- JOB SEEKER ROUTES ----------
Route::middleware(['auth', 'role:job_seeker'])->group(function () {
    Route::get('/dashboard/job-seeker', function () {
        return view('dashboards.jobseeker');
    })->name('jobseeker.dashboard');
});

Route::middleware(['auth', 'role:job_seeker'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'role:job_seeker'])->group(function () {
    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index'); // browse jobs
    Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show'); // view job
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'apply'])->name('jobs.apply'); // apply
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index'); // track applications
    Route::get('/applications/{application}', [ApplicationController::class, 'show'])->name('applications.show'); // view application
});

Route::middleware(['auth', 'role:job_seeker'])->group(function () {

    // ---------- Show Notifications Page ----------
    Route::get('/notifications', function () {
        // This loads resources/views/jobseeker/notifications/index.blade.php
        return view('jobseeker.notifications.index');
    })->name('job_seeker.notifications');

    // ---------- Mark a Notification as Read ----------
    Route::post('/notifications/{id}/read', function ($id) {
        // Find the notification for the authenticated user
        $notification = auth()->user()->notifications()->findOrFail($id);

        // Mark it as read
        $notification->markAsRead();

        // Redirect back to the notifications page
        return back()->with('success', 'Notification marked as read.');
    })->name('job_seeker.notifications.read');

});
// EMPLOYER ROUTES ----------

Route::middleware(['auth', 'role:employer'])->group(function () {

    // Dashboard
    Route::get('/dashboard/employer', function () {
        return view('dashboards.employer');
    })->name('employer.dashboard');

    Route::get('/employer/profile/edit', [EmployerController::class, 'editProfile'])->name('employer.profile.edit');
    Route::put('/employer/profile', [EmployerController::class, 'updateProfile'])->name('employer.profile.update');

    // Applications
    Route::get('/employer/applications', [ApplicationController::class, 'employerIndex'])->name('employer.applications.index');
    Route::get('/employer/applications/{application}', [ApplicationController::class, 'employerShow'])->name('employer.applications.show');
    Route::post('/employer/applications/{application}/status', [ApplicationController::class, 'updateStatus'])->name('employer.applications.updateStatus');

    // Jobs
    Route::get('/employer/jobs', [JobController::class, 'employerIndex'])->name('employer.jobs.index');
    Route::get('/employer/jobs/create', [JobController::class, 'create'])->name('employer.jobs.create');
    Route::post('/employer/jobs', [JobController::class, 'store'])->name('employer.jobs.store');
    Route::get('/employer/jobs/{job}/edit', [JobController::class, 'edit'])->name('employer.jobs.edit');
    Route::put('/employer/jobs/{job}', [JobController::class, 'update'])->name('employer.jobs.update');
    Route::delete('/employer/jobs/{job}', [JobController::class, 'destroy'])->name('employer.jobs.destroy');

});

// ADMIN ROUTES ----------

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard/admin', function () {
        return view('dashboards.admin');
    })->name('admin.dashboard');
});

//candidate routes
Route::get('/candidates', [CandidateController::class, 'index'])->name('candidates.index');
Route::post('/candidates/{candidate}/status', [CandidateController::class, 'updateStatus'])
     ->name('candidates.updateStatus');

