<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\ActivityLog;

class JobController extends Controller
{
    // Job Seeker: Browse & Search Jobs
    public function index(Request $request)
    {
        $query = Job::query();

        // CRITICAL: Only show active jobs to job seekers
        $query->where('status', 'active');

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($request->filled('experience_level')) {
            $query->where('experience_level', $request->experience_level);
        }

        if ($request->filled('skills')) {
            $skillNames = array_map('trim', explode(',', $request->skills));
            $query->where(function ($q) use ($skillNames) {
                foreach ($skillNames as $skill) {
                    $q->orWhereJsonContains('skills_required', $skill);
                }
            });
        }

        // Exclude jobs already applied to by the authenticated user
        if (Auth::check()) {
            $appliedJobIds = Auth::user()->applications()->pluck('job_id')->toArray();
            if (!empty($appliedJobIds)) {
                $query->whereNotIn('id', $appliedJobIds);
            }
        }

        $jobs = $query
            ->with('employer.employerProfile')
            ->latest()
            ->paginate(3);

        return view('jobseeker.jobs.index', compact('jobs'));
    }

    // Job Seeker: View single job
    public function show(Job $job)
    {
        return view('jobseeker.jobs.show', compact('job'));
    }

    // Employer: List my jobs with pagination
    public function employerIndex(Request $request)
    {
        $query = Job::where('employer_id', Auth::id());

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $jobs = $query->latest()->paginate(5);

        return view('employer.jobs.index', compact('jobs'));
    }

    // Employer: View single job (owned by employer)
    public function employerShow(Job $job)
    {
        if ($job->employer_id !== Auth::id()) {
            abort(403);
        }

        return view('employer.jobs.show', compact('job'));
    }

    // Employer: Show create form
    public function create()
    {
        return view('employer.jobs.create', ['job' => null]);
    }

    // Employer: Store new job
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|numeric',
            'experience_level' => 'nullable|string|max:100',
            'skills_required' => 'required|string',
        ]);

        $validated = $validator->validate();

        // Convert comma-separated string to array
        $validated['skills_required'] = array_map('trim', explode(',', $request->skills_required));
        $validated['employer_id'] = Auth::id();
        $validated['status'] = 'pending';

        $job = Job::create(collect($validated)->only([
            'title',
            'description',
            'location',
            'salary',
            'experience_level',
            'skills_required',
            'employer_id',
            'status',
        ])->all());

        // Activity Log
        $user = Auth::user();
        ActivityLog::create([
            'user_id' => $user ? $user->id : null,
            'action' => 'New job posting created',
            'description' => $job->title . ' at ' . $job->location,
            'job_id' => $job->id,
        ]);

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job created successfully.');
    }

    // Employer: Show edit form
    public function edit(Job $job)
    {
        $this->authorize('update', $job);
        return view('employer.jobs.edit', compact('job'));
    }

    // Employer: Update job
    public function update(Request $request, Job $job)
    {
        $this->authorize('update', $job);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|numeric',
            'experience_level' => 'nullable|string|max:100',
            'skills_required' => 'required|string',
        ]);

        $validated = $validator->validate();

        // Convert comma-separated string to array
        $validated['skills_required'] = array_map('trim', explode(',', $request->skills_required));

        $job->update(collect($validated)->only([
            'title',
            'description',
            'location',
            'salary',
            'experience_level',
            'skills_required',
        ])->all());

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job updated successfully.');
    }

    // Employer: Delete job
    public function destroy(Job $job)
    {
        $this->authorize('delete', $job);
        $job->delete();

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job deleted successfully.');
    }

    // Job Seeker: Show apply form
    public function applyForm(Job $job)
    {
        // Fetch required skills from the job (array)
        $skills = $job->skills_required ?? [];

        return view('jobseeker.jobs.apply', compact('job', 'skills'));
    }
}