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

        return view('applications.index', compact('applications'));
    }

    // Show a single application
    public function show(Application $application)
    {
        $user = Auth::user();

        // Make sure the user owns the application
        if ($application->user_id !== $user->id) {
            abort(403);
        }

        return view('applications.show', compact('application'));
    }
}