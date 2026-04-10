<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class EmployerLiveSkillQaController extends Controller
{
    public function index()
    {
        $jobs = Job::query()
            ->where('employer_id', Auth::id())
            ->with('liveSkillQa')
            ->latest()
            ->get()
            ->filter(fn ($job) => (bool) ($job->liveSkillQa->enabled ?? false));

        return view('employer.live_skill_qa.index', [
            'jobs' => $jobs,
        ]);
    }

    public function show(Job $job)
    {
        if ($job->employer_id !== Auth::id()) {
            abort(403);
        }

        $job->load('liveSkillQa');

        return view('employer.live_skill_qa.show', [
            'job' => $job,
        ]);
    }
}

