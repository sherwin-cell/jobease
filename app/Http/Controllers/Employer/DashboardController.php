<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\Application;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get all jobs for this employer
        $jobs = Job::where('employer_id', $user->id)
            ->withCount('applications')
            ->latest()
            ->get();
        
        // Calculate stats
        $activeJobs = $jobs->where('status', 'active')->count();
        $pendingJobs = $jobs->where('status', 'pending')->count();
        $rejectedJobs = $jobs->where('status', 'rejected')->count();
        $totalJobs = $jobs->count();
        
        // Get all applications for employer's jobs
        $jobIds = $jobs->pluck('id')->toArray();
        $totalApplicants = Application::whereIn('job_id', $jobIds)->count();
        
        // Get applicants this month
        $applicantsThisMonth = Application::whereIn('job_id', $jobIds)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        
        // Get shortlisted applications
        $shortlisted = Application::whereIn('job_id', $jobIds)
            ->whereIn('status', ['shortlisted', 'interview', 'interview_scheduled'])
            ->count();
        
        // Get scheduled interviews
        $interviews = Application::whereIn('job_id', $jobIds)
            ->whereIn('status', ['interview', 'interview_scheduled'])
            ->count();
        
        // Get recent applications (last 5)
        $recentApplications = Application::whereIn('job_id', $jobIds)
            ->with('job', 'user')
            ->latest()
            ->take(5)
            ->get();
        
        return view('dashboards.employer', compact(
            'jobs',
            'activeJobs',
            'pendingJobs',
            'rejectedJobs',
            'totalJobs',
            'totalApplicants',
            'applicantsThisMonth',
            'shortlisted',
            'interviews',
            'recentApplications'
        ));
    }
}