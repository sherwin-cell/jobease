<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Job;
use App\Models\Application;
use App\Models\ActivityLog;
class AdminDashboardController extends Controller
{
    public function index()
    {
        // Exclude admin (role_id = 3)
        $totalUsers = User::where('role_id', '!=', 3)->count();

        $totalJobSeekers = User::where('role_id', 1)->count();

        $totalEmployers = User::where('role_id', 2)->count();

        $activeJobs = Job::count();

        $totalJobs = Job::count();

        $totalApplications = Application::count();

        // Exclude admin from banned users
        $bannedUsers = User::where('is_banned', true)
            ->where('role_id', '!=', 3)
            ->count();

        $users = User::where('role_id', '!=', 3)
            ->latest()
            ->get();

        $jobs = Job::withCount('applications')
            ->latest()
            ->get();

        $logs = ActivityLog::with('user')->latest()->limit(20)->get();

        return view('dashboards.admin', compact(
            'totalUsers',
            'totalJobSeekers',
            'totalEmployers',
            'totalJobs',
            'activeJobs',
            'totalApplications',
            'bannedUsers',
            'users',
            'jobs',
            'logs'
        ));
    }
}