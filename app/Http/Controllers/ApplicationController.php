<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use App\Models\Job;

class ApplicationController extends Controller
{
    // Apply to a job
    public function apply(Job $job)
    {
        $user = Auth::user();

        // Prevent duplicate applications
        if ($user->applications()->where('job_id', $job->id)->exists()) {
            return back()->with('error', 'You have already applied to this job.');
        }

        $user->applications()->create([
            'job_id' => $job->id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Application submitted successfully.');
    }

    // Show all applications of logged-in user
    public function index()
    {
        $user = Auth::user();
        $applications = $user->applications()->with('job')->latest()->get();

        return view('jobseeker.applications.index', compact('applications'));
    }

    // Show a single application (job seeker)
    public function show(Application $application)
    {
        $user = Auth::user();

        // Make sure the user owns the application
        if ($application->user_id !== $user->id) {
            abort(403);
        }

        return view('jobseeker.applications.show', compact('application'));
    }

    // ---------- Employer: List applications for my jobs ----------
    public function employerIndex()
    {
        $jobIds = Auth::user()->jobs()->pluck('id');
        $applications = Application::whereIn('job_id', $jobIds)->with(['job', 'user'])->latest()->get();
        return view('employer.applications.index', compact('applications'));
    }

    // Employer: Show single application
    public function employerShow(Application $application)
    {
        $user = Auth::user();
        if ($application->job->employer_id !== $user->id) {
            abort(403);
        }
        $application->load(['job', 'user']);
        return view('employer.applications.show', compact('application'));
    }

    // Employer: Update application status
    public function updateStatus(Request $request, Application $application)
    {
        $user = Auth::user();
        if ($application->job->employer_id !== $user->id) {
            abort(403);
        }
        $request->validate(['status' => 'required|in:pending,shortlisted,rejected,hired']);
        $application->update(['status' => $request->status]);
        return back()->with('success', 'Application status updated.');
    }
}