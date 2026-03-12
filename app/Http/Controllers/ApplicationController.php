<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use App\Models\Job;

class ApplicationController extends Controller
{
    // Show apply form
    public function applyForm(Job $job)
    {
        return view('jobseeker.jobs.apply', compact('job'));
    }

    // Submit application
    public function apply(Request $request, Job $job)
    {
        $user = Auth::user();

        // Check if already applied
        if ($user->applications()->where('job_id', $job->id)->exists()) {
            return back()->with('error', 'You have already applied to this job.');
        }

        // Validate input
        $validated = $request->validate([
            'cover_letter' => 'nullable|string|max:1000',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ]);

        // Upload resume if provided
        $resumePath = null;
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        }

        // Create application
        $user->applications()->create([
            'job_id' => $job->id,
            'cover_letter' => $validated['cover_letter'] ?? null,
            'resume' => $resumePath,
            'status' => 'pending',
        ]);

        return redirect()->route('jobseeker.applications.index')
            ->with('success', 'Application submitted successfully!');
    }

    // Show all applications
    public function index()
    {
        $user = Auth::user();
        $applications = $user->applications()->with('job')->latest()->get();
        return view('jobseeker.applications.index', compact('applications'));
    }

    // Show single application
    public function show(Application $application)
    {
        if ($application->user_id !== Auth::id()) {
            abort(403);
        }
        $application->load('job');
        return view('jobseeker.applications.show', compact('application'));
    }

    // Employer: List applications
    public function employerIndex()
    {
        $jobIds = Auth::user()->jobs()->pluck('id');
        $applications = Application::whereIn('job_id', $jobIds)->with(['job', 'user'])->latest()->get();
        return view('employer.applications.index', compact('applications'));
    }

    // Employer: Show single application
    public function employerShow(Application $application)
    {
        if ($application->job->employer_id !== Auth::id()) {
            abort(403);
        }
        $application->load(['job', 'user']);
        return view('employer.applications.show', compact('application'));
    }

    // Employer: Update application status
    public function updateStatus(Request $request, Application $application)
    {
        // Only allow employer to update status
        if ($application->job->employer_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,shortlisted,rejected,hired',
        ]);

        $application->status = $validated['status'];
        $application->save();

        // Check if it's an AJAX request
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'status' => $application->status,
                'message' => 'Application status updated to ' . ucfirst($application->status) . '.',
            ]);
        }

        // Otherwise redirect with success message
        return redirect()->route('employer.applications.show', $application->id)
            ->with('success', 'Application status updated to ' . ucfirst($application->status) . '.');
    }
}