<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobLiveSkillQaSession;
use App\Models\JobLiveSkillQaSessionParticipant;
use App\Models\Application;
use App\Services\Agora\AgoraService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LiveSkillQaCallController extends Controller
{
    public function employerStart(Job $job, Request $request)
    {
        if ($job->employer_id !== Auth::id()) {
            abort(403);
        }

        $job->load('liveSkillQa');
        $qa = $job->liveSkillQa;
        if (!($qa?->enabled)) {
            return back()->with('error', 'Live Skill Q&A is not enabled for this job.');
        }

        $validated = $request->validate([
            'slot_index' => 'required|integer|min:0|max:200',
        ]);

        $slots = is_array($qa->slots ?? null) ? $qa->slots : [];
        $slot = $slots[$validated['slot_index']] ?? null;
        if (!$slot || empty($slot['start_at']) || empty($slot['end_at'])) {
            return back()->with('error', 'Invalid slot selected.');
        }

        $startAt = Carbon::parse($slot['start_at']);
        $endAt = Carbon::parse($slot['end_at']);

        $session = JobLiveSkillQaSession::create([
            'job_id' => $job->id,
            'created_by' => Auth::id(),
            'slot_start_at' => $startAt,
            'slot_end_at' => $endAt,
            'agora_channel_name' => 'liveqa-' . $job->id . '-' . Str::random(10),
            'status' => 'live',
            'started_at' => now(),
        ]);

        JobLiveSkillQaSessionParticipant::updateOrCreate(
            ['session_id' => $session->id, 'user_id' => Auth::id()],
            ['role' => 'employer', 'joined_at' => now()]
        );

        return redirect()->route('employer.live-skill-qa.call', $session);
    }

    public function employerCall(JobLiveSkillQaSession $session)
    {
        $session->load('job.liveSkillQa');
        if ($session->job->employer_id !== Auth::id()) {
            abort(403);
        }

        JobLiveSkillQaSessionParticipant::updateOrCreate(
            ['session_id' => $session->id, 'user_id' => Auth::id()],
            ['role' => 'employer', 'joined_at' => now()]
        );

        return view('live_skill_qa.call', [
            'session' => $session,
            'role' => 'employer',
        ]);
    }

    public function jobseekerJoin(JobLiveSkillQaSession $session)
    {
        $session->load('job.liveSkillQa');
        if (!Auth::user()?->isJobSeeker()) {
            abort(403);
        }

        if ($session->status !== 'live') {
            return redirect()->route('jobseeker.dashboard')->with('error', 'Session is not active.');
        }

        $hasApplied = Application::where('user_id', Auth::id())->where('job_id', $session->job_id)->exists();
        if (!$hasApplied) {
            abort(403);
        }

        $max = (int) ($session->job->liveSkillQa->max_candidates ?? 10);
        $jobSeekerCount = JobLiveSkillQaSessionParticipant::where('session_id', $session->id)
            ->where('role', 'job_seeker')
            ->count();
        if ($jobSeekerCount >= $max) {
            return redirect()->route('jobseeker.dashboard')->with('error', 'This session is already full.');
        }

        JobLiveSkillQaSessionParticipant::updateOrCreate(
            ['session_id' => $session->id, 'user_id' => Auth::id()],
            ['role' => 'job_seeker', 'joined_at' => now()]
        );

        return view('live_skill_qa.call', [
            'session' => $session,
            'role' => 'job_seeker',
        ]);
    }

    public function token(JobLiveSkillQaSession $session)
    {
        $session->load('job');
        $user = Auth::user();
        if (!$user) {
            abort(401);
        }

        $isEmployer = $user->isEmployer() && $session->job->employer_id === $user->id;
        $isJobSeeker = $user->isJobSeeker() && Application::where('user_id', $user->id)->where('job_id', $session->job_id)->exists();
        if (!$isEmployer && !$isJobSeeker) {
            abort(403);
        }

        $uid = (int) $user->id;
        $expireSeconds = 2 * 60 * 60; // 2 hours
        $channelName = $session->agora_channel_name;
        $token = AgoraService::generateToken($channelName, $uid, $expireSeconds);

        return response()->json([
            'appId' => config('services.agora.app_id'),
            'channel' => $channelName,
            'uid' => $uid,
            'token' => $token,
        ]);
    }
}

