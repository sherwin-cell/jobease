<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;

class JobController extends Controller
{
    // Job Seeker: Browse & Search Jobs
    public function index(Request $request)
    {
        $query = Job::query();

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

        $jobs = $query->latest()->paginate(10);
        return view('jobseeker.jobs.index', compact('jobs'));
    }

    // Job Seeker: View single job
    public function show(Job $job)
    {
        return view('jobseeker.jobs.show', compact('job'));
    }

    // Employer: List my jobs
    public function employerIndex()
    {
        $jobs = Job::where('employer_id', Auth::id())
            ->latest()
            ->get();

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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|numeric',
            'experience_level' => 'nullable|string|max:100',
            'skills_required' => 'required|string', // REQUIRED
            'qa_questions' => 'nullable|array',
            'qa_questions.*' => 'nullable|string|max:500',
        ]);

        // Convert comma-separated string to array
        $validated['skills_required'] = array_map('trim', explode(',', $request->skills_required));
        $validated['employer_id'] = Auth::id();
        $validated['qa_questions'] = $this->filterQaQuestions($request->input('qa_questions', []));

        Job::create($validated);

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

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|numeric',
            'experience_level' => 'nullable|string|max:100',
            'skills_required' => 'required|string', // REQUIRED
            'qa_questions' => 'nullable|array',
            'qa_questions.*' => 'nullable|string|max:500',
        ]);

        // Convert comma-separated string to array
        $validated['skills_required'] = array_map('trim', explode(',', $request->skills_required));
        $validated['qa_questions'] = $this->filterQaQuestions($request->input('qa_questions', []));

        $job->update($validated);

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
        return view('jobseeker.jobs.apply', compact('job'));
    }

    private function filterQaQuestions(array $questions): array
    {
        return array_values(array_filter($questions, fn($q) => !empty(trim($q))));
    }
}