<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\JobLiveSkillQa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

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
            'skills_required' => 'required|string', // REQUIRED
            'live_skill_qa_enabled' => 'nullable|boolean',
            'live_skill_qa_duration_minutes' => 'nullable|in:15,30',
            'live_skill_qa_max_candidates' => 'nullable|integer|min:1|max:500',
            'live_skill_qa_session_type' => 'nullable|in:video_audio,audio_only,screen_share',
            'live_skill_qa_screen_sharing_allowed' => 'nullable|boolean',
            'live_skill_qa_question_categories' => 'nullable|string|max:2000',
            'live_skill_qa_questions' => 'nullable|string|max:5000',
            'live_skill_qa_slot_start' => 'array',
            'live_skill_qa_slot_start.*' => 'nullable|date',
            'live_skill_qa_slot_end' => 'array',
            'live_skill_qa_slot_end.*' => 'nullable|date',
        ]);

        $validator->after(function ($validator) use ($request) {
            $starts = $request->input('live_skill_qa_slot_start', []);
            $ends = $request->input('live_skill_qa_slot_end', []);
            $count = max(count($starts), count($ends));

            for ($i = 0; $i < $count; $i++) {
                $start = $starts[$i] ?? null;
                $end = $ends[$i] ?? null;

                if (!$start || !$end) {
                    continue;
                }

                try {
                    $startAt = Carbon::parse($start);
                    $endAt = Carbon::parse($end);
                } catch (\Throwable $e) {
                    continue;
                }

                if ($endAt->lessThanOrEqualTo($startAt)) {
                    $validator->errors()->add("live_skill_qa_slot_end.$i", "The end time must be after the start time.");
                }
            }
        });

        $validated = $validator->validate();

        // Convert comma-separated string to array
        $validated['skills_required'] = array_map('trim', explode(',', $request->skills_required));
        $validated['employer_id'] = Auth::id();

        $job = DB::transaction(function () use ($validated, $request) {
            $job = Job::create(collect($validated)->only([
                'title',
                'description',
                'location',
                'salary',
                'experience_level',
                'skills_required',
                'employer_id',
            ])->all());

            $this->upsertLiveSkillQa($job, $request);

            return $job;
        });

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job created successfully.');
    }

    // Employer: Show edit form
    public function edit(Job $job)
    {
        $this->authorize('update', $job);
        $job->load('liveSkillQa');
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
            'skills_required' => 'required|string', // REQUIRED
            'live_skill_qa_enabled' => 'nullable|boolean',
            'live_skill_qa_duration_minutes' => 'nullable|in:15,30',
            'live_skill_qa_max_candidates' => 'nullable|integer|min:1|max:500',
            'live_skill_qa_session_type' => 'nullable|in:video_audio,audio_only,screen_share',
            'live_skill_qa_screen_sharing_allowed' => 'nullable|boolean',
            'live_skill_qa_question_categories' => 'nullable|string|max:2000',
            'live_skill_qa_questions' => 'nullable|string|max:5000',
            'live_skill_qa_slot_start' => 'array',
            'live_skill_qa_slot_start.*' => 'nullable|date',
            'live_skill_qa_slot_end' => 'array',
            'live_skill_qa_slot_end.*' => 'nullable|date',
        ]);

        $validator->after(function ($validator) use ($request) {
            $starts = $request->input('live_skill_qa_slot_start', []);
            $ends = $request->input('live_skill_qa_slot_end', []);
            $count = max(count($starts), count($ends));

            for ($i = 0; $i < $count; $i++) {
                $start = $starts[$i] ?? null;
                $end = $ends[$i] ?? null;

                if (!$start || !$end) {
                    continue;
                }

                try {
                    $startAt = Carbon::parse($start);
                    $endAt = Carbon::parse($end);
                } catch (\Throwable $e) {
                    continue;
                }

                if ($endAt->lessThanOrEqualTo($startAt)) {
                    $validator->errors()->add("live_skill_qa_slot_end.$i", "The end time must be after the start time.");
                }
            }
        });

        $validated = $validator->validate();

        // Convert comma-separated string to array
        $validated['skills_required'] = array_map('trim', explode(',', $request->skills_required));

        DB::transaction(function () use ($job, $validated, $request) {
            $job->update(collect($validated)->only([
                'title',
                'description',
                'location',
                'salary',
                'experience_level',
                'skills_required',
            ])->all());

            $this->upsertLiveSkillQa($job, $request);
        });

        return redirect()->route('employer.jobs.index')
            ->with('success', 'Job updated successfully.');
    }

    private function upsertLiveSkillQa(Job $job, Request $request): void
    {
        $enabled = (bool) $request->boolean('live_skill_qa_enabled');

        $slotStarts = $request->input('live_skill_qa_slot_start', []);
        $slotEnds = $request->input('live_skill_qa_slot_end', []);
        $slots = [];
        $count = max(count($slotStarts), count($slotEnds));
        for ($i = 0; $i < $count; $i++) {
            $start = $slotStarts[$i] ?? null;
            $end = $slotEnds[$i] ?? null;
            if (!$start || !$end) {
                continue;
            }
            $slots[] = [
                'start_at' => $start,
                'end_at' => $end,
            ];
        }

        $categoriesRaw = (string) $request->input('live_skill_qa_question_categories', '');
        $categories = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $categoriesRaw))));

        $questionsRaw = (string) $request->input('live_skill_qa_questions', '');
        $questions = [];
        foreach (array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $questionsRaw))) as $line) {
            $questions[] = ['question' => $line];
        }

        JobLiveSkillQa::updateOrCreate(
            ['job_id' => $job->id],
            [
                'enabled' => $enabled,
                'duration_minutes' => $enabled ? (int) $request->input('live_skill_qa_duration_minutes') : null,
                'max_candidates' => $enabled ? (int) $request->input('live_skill_qa_max_candidates') : null,
                'session_type' => $enabled ? (string) $request->input('live_skill_qa_session_type') : null,
                'screen_sharing_allowed' => $enabled ? (bool) $request->boolean('live_skill_qa_screen_sharing_allowed') : false,
                'slots' => $enabled ? $slots : null,
                'question_categories' => $enabled ? $categories : null,
                'questions' => $enabled ? $questions : null,
            ]
        );
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
}