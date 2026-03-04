<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;

// ---------- Public Routes ----------
// Public routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

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
});

// EMPLOYER ROUTES ----------

Route::middleware(['auth', 'role:employer'])->group(function () {
    Route::get('/dashboard/employer', function () {
        return 'Employer Dashboard';
    })->name('employer.dashboard');
});

Route::middleware(['auth', 'role:employer'])->group(function () {
    Route::get('/employer/applications', [ApplicationController::class, 'index'])->name('employer.applications.index'); // list all applications
    Route::get('/employer/applications/{application}', [ApplicationController::class, 'show'])->name('employer.applications.show'); // view one application
    Route::post('/employer/applications/{application}/status', [ApplicationController::class, 'updateStatus'])->name('employer.applications.updateStatus'); // change status
});

Route::middleware(['auth', 'role:employer'])->group(function () {
    Route::get('/employer/jobs', [JobController::class, 'index'])->name('employer.jobs.index'); // list jobs
    Route::get('/employer/jobs/create', [JobController::class, 'create'])->name('employer.jobs.create'); // create form
    Route::post('/employer/jobs', [JobController::class, 'store'])->name('employer.jobs.store'); // save job
    Route::get('/employer/jobs/{job}/edit', [JobController::class, 'edit'])->name('employer.jobs.edit'); // edit form
    Route::put('/employer/jobs/{job}', [JobController::class, 'update'])->name('employer.jobs.update'); // update
    Route::delete('/employer/jobs/{job}', [JobController::class, 'destroy'])->name('employer.jobs.destroy'); // delete
});

// ADMIN ROUTES ----------

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard/admin', function () {
        return 'Admin Dashboard';
    })->name('admin.dashboard');
});

