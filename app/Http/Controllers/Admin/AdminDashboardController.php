<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Job;
use App\Models\Application;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Exclude admin (role_id = 3)
        $totalUsers = User::where('role_id', '!=', 3)->count();

        $totalJobs = Job::count();

        $totalApplications = Application::count();

        // Exclude admin from banned users
        $bannedUsers = User::where('is_banned', true)
            ->where('role_id', '!=', 3)
            ->count();

        return view('dashboards.admin', compact(
            'totalUsers',
            'totalJobs',
            'totalApplications',
            'bannedUsers'
        ));
    }
}