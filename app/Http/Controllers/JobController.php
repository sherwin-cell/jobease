<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\Application;

class JobController extends Controller
{
    // -----------------------------
    // Job Seeker: Browse & Search Jobs
    // -----------------------------
    public function index(Request $request)
    {
        $query = Job::query();

        // Filters for job seekers
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($request->filled('experience_level')) {
            $query->where('experience_level', $request->experience_level);
        }

        if ($request->filled('skills')) {
            $skills = explode(',', $request->skills);
            $query->where(function ($q) use ($skills) {
                foreach ($skills as $skill) {
                    $q->orWhere('skills_required', 'like', '%' . $skill . '%');
                }
            });
        }

        $jobs = $query->latest()->paginate(10);

        return view('jobs.index', compact('jobs'));
    }

    // Job Seeker: View single job details
    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }

    // -----------------------------
    // Employer: List my jobs
    // -----------------------------
    public function employerIndex()
    {
        $jobs = Job::where('company_id', Auth::id())->latest()->get();
        return view('employer.jobs.index', compact('jobs'));
    }

    // Employer: Show create form
    public function create()
    {
        return view('employer.jobs.create');
    }

    // Employer: Store new job
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|numeric',
            'experience_level' => 'nullable|string|max:100',
        ]);

        Job::create([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'salary' => $request->salary,
            'experience_level' => $request->experience_level,
            'company_id' => Auth::id(),
        ]);

        return redirect()->route('employer.jobs.index')->with('success', 'Job posted successfully.');
    }

    // Employer: Edit job
    public function edit(Job $job)
    {
        $this->authorize('update', $job);
        return view('employer.jobs.edit', compact('job'));
    }

    // Employer: Update job
    public function update(Request $request, Job $job)
    {
        $this->authorize('update', $job);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|numeric',
            'experience_level' => 'nullable|string|max:100',
        ]);

        $job->update($request->only('title','description','location','salary','experience_level'));
        return redirect()->route('employer.jobs.index')->with('success', 'Job updated successfully.');
    }

    // Employer: Delete job
    public function destroy(Job $job)
    {
        $this->authorize('delete', $job);
        $job->delete();
        return redirect()->route('employer.jobs.index')->with('success', 'Job deleted successfully.');
    }
}