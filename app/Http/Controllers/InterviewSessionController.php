<?php

namespace App\Http\Controllers;

use App\Models\InterviewSession;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Auth;

class InterviewSessionController extends Controller
{
    // Employer creates interview sessions
    public function store(Request $request)
    {
        $request->validate([
            'job_id' => 'required',
            'application_id' => 'required',
            'job_seeker_id' => 'required',
            'slots' => 'required|array',
        ]);

        foreach ($request->slots as $slot) {
            InterviewSession::create([
                'job_id' => $request->job_id,
                'application_id' => $request->application_id,
                'job_seeker_id' => $request->job_seeker_id,
                'employer_id' => auth()->id(),
                'scheduled_at' => $slot,
                'room_id' => 'room_' . \Illuminate\Support\Str::uuid(),
                'status' => 'pending',
            ]);
        }

        return back()->with('success', 'Interview scheduled!');
    }

    // Employer dashboard
    public function employerIndex()
    {
        $sessions = InterviewSession::where('employer_id', auth()->id())
            ->orderBy('scheduled_at')
            ->get();

        return view('interviews.employer', compact('sessions'));
    }

    // Job seeker dashboard
    public function jobSeekerIndex()
    {
        $sessions = InterviewSession::where('job_seeker_id', auth()->id())
            ->orderBy('scheduled_at')
            ->get();

        return view('interviews.jobseeker', compact('sessions'));
    }

    // Join interview page
    public function join($id)
    {
        $session = InterviewSession::findOrFail($id);

        // SECURITY CHECK
        if (
            $session->job_seeker_id !== auth()->id() &&
            $session->employer_id !== auth()->id()
        ) {
            abort(403);
        }

        return view('interviews.call', compact('session'));
    }

    public function call(InterviewSession $session)
    {
        $appID = 948409277;
        $serverSecret = env('ZEGO_SERVER_SECRET');

        if (!$serverSecret) {
            abort(500, 'ZEGO_SERVER_SECRET is not set');
        }

        $userID = Auth::id();
        $userName = Auth::user()->name;
        $roomID = "room_" . $session->id;

        $expire = time() + 2 * 60 * 60;

        $payload = [
            'app_id' => $appID,
            'user_id' => (string) $userID,
            'room_id' => $roomID,
            'exp' => $expire,
        ];

        $kitToken = JWT::encode($payload, $serverSecret, 'HS256');

        return view('interviews.call', compact(
            'session',
            'kitToken',
            'appID',
            'userID',
            'userName',
            'roomID'
        ));
    }

    // Start interview (employer)
    public function start($id)
    {
        $session = InterviewSession::findOrFail($id);
        $session->update(['status' => 'active']);

        return redirect()->route('interviews.join', $id);
    }
}