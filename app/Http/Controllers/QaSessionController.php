<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobLiveSkillQaSession;
use Illuminate\Support\Str;

class QaSessionController extends Controller  // ← Make sure this class exists
{
    public function joinVideoCall(JobLiveSkillQaSession $session)
    {
        // Security Check
        if (!$this->canJoinSession($session)) {
            abort(403, 'You are not allowed to join this session.');
        }

        // Generate unique room name
        $roomName = 'jobease-qa-' . $session->id . '-' . Str::slug($session->job?->title ?? 'interview');

        return view('live.qa.video-call', [
            'roomName' => $roomName,
            'session'  => $session
        ]);
    }

    // Helper method (you can improve this later)
    private function canJoinSession(JobLiveSkillQaSession $session): bool
    {
        $user = auth()->user();
        
        // Allow if user is the employer OR the job seeker
        return $user->id === $session->employer_id || 
               $user->id === $session->job_seeker_id;
    }
}