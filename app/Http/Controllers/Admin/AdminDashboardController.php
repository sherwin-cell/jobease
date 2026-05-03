<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Job;
use App\Models\Application;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Exclude admin (role_id = 3)
        $totalUsers = User::where('role_id', '!=', 3)->count();

        $totalJobSeekers = User::where('role_id', 1)->count();

        $totalEmployers = User::where('role_id', 2)->count();

        $activeJobs = Job::where('status', 'active')->count();

        $totalJobs = Job::count();

        $totalApplications = Application::count();

        // Exclude admin from banned users
        $bannedUsers = User::where('is_banned', true)
            ->where('role_id', '!=', 3)
            ->count();

        $users = User::where('role_id', '!=', 3)
            ->with('employerProfile', 'jobseekerProfile')
            ->latest()
            ->get();

        $jobs = Job::withCount('applications')
            ->with('employer.employerProfile')
            ->latest()
            ->get();

        // Only show logs from existing users or system logs
        $logs = ActivityLog::with('user')
            ->where(function ($query) {
                $query->whereNull('user_id')
                    ->orWhereHas('user');
            })
            ->latest()
            ->limit(20)
            ->get();

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

    /**
     * Delete a user and all their related data
     */
    public function destroyUser($id)
    {
        $user = User::findOrFail($id);

        // Prevent admin from deleting themselves
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.dashboard')->with('error', 'You cannot delete your own account.');
        }

        // Log the deletion before removing the user
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'User Account Deleted',
            'description' => "Deleted user: {$user->name} (Email: {$user->email}) - Role: " . ($user->role_id == 1 ? 'Job Seeker' : ($user->role_id == 2 ? 'Employer' : 'Admin')),
        ]);

        // Delete all related records based on role
        if ($user->isEmployer()) {
            // Delete all jobs posted by this employer (applications and interviews will cascade)
            foreach ($user->jobs as $job) {
                // Delete related applications first
                $job->applications()->delete();
                // Delete the job
                $job->delete();
            }
            // Delete employer profile
            if ($user->employerProfile) {
                $user->employerProfile()->delete();
            }
        }

        if ($user->isJobSeeker()) {
            // Delete all applications submitted by this job seeker
            $user->applications()->delete();
            // Delete job seeker profile
            if ($user->jobseekerProfile) {
                $user->jobseekerProfile()->delete();
            }
        }

        // Delete all activity logs related to this user
        ActivityLog::where('user_id', $user->id)->delete();

        // Delete the user
        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'User account and all related data deleted successfully.');
    }

    /**
     * Ban a user
     */
    public function banUser($id)
    {
        $user = User::findOrFail($id);

        // Prevent admin from banning themselves
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.dashboard')->with('error', 'You cannot ban your own account.');
        }

        $user->update(['is_banned' => true]);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'User Banned',
            'description' => "Banned user: {$user->name} (Email: {$user->email})",
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'User banned successfully.');
    }

    /**
     * Unban a user
     */
    public function unbanUser($id)
    {
        $user = User::findOrFail($id);

        $user->update(['is_banned' => false]);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'User Unbanned',
            'description' => "Unbanned user: {$user->name} (Email: {$user->email})",
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'User unbanned successfully.');
    }

    /**
     * Delete a specific job
     */
    public function destroyJob($id)
    {
        $job = Job::findOrFail($id);
        $jobTitle = $job->title;

        // Log the deletion
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Job Posting Deleted',
            'description' => "Deleted job: {$jobTitle}",
        ]);

        // Delete related applications first
        $job->applications()->delete();

        // Delete the job
        $job->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Job posting deleted successfully.');
    }

    /**
     * Clean up orphaned activity logs (one-time use)
     */
    public function cleanupOrphanedLogs()
    {
        // Delete logs where user doesn't exist (regardless of user_id)
        $deleted = ActivityLog::whereDoesntHave('user')
            ->delete();

        // Also delete logs with invalid user_id values
        $deleted += ActivityLog::whereNotNull('user_id')
            ->whereNotIn('user_id', User::pluck('id')->toArray())
            ->delete();

        return redirect()->route('admin.dashboard')->with('success', "Cleaned up {$deleted} orphaned activity logs.");
    }
    public function destroy(User $user)
    {
        // Delete activity logs first
        ActivityLog::where('user_id', $user->id)->delete();

        // Then delete the user
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }
}