<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use App\Models\Job;
use App\Models\InterviewSession;
use Illuminate\Support\Facades\Mail;
use App\Mail\InterviewScheduledMail;
use Illuminate\Support\Str;

class ApplicationController extends Controller
{
    // Show apply form
    public function applyForm(Job $job)
    {
        // Eager load skill questions
        $job->load('skillQuestions');
        $questions = $job->skillQuestions;
        return view('jobseeker.jobs.apply', compact('job', 'questions'));
    }

    // Submit application
    public function apply(Request $request, Job $job)
    {
        $user = Auth::user();

        // Check if already applied
        if ($user->applications()->where('job_id', $job->id)->exists()) {
            return back()->with('error', 'You have already applied to this job.');
        }

        // Build validation rules
        $rules = [
            'cover_letter' => 'nullable|string|max:1000',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ];

        // Validate Skill Questions
        $job->load('skillQuestions');
        foreach ($job->skillQuestions as $question) {
            $rules['answers.' . $question->id] = 'required|string|max:1000';
        }

        $validated = $request->validate($rules);

        // Upload resume if provided
        $resumePath = null;
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        }

        // Create application
        $application = $user->applications()->create([
            'job_id' => $job->id,
            'cover_letter' => $validated['cover_letter'] ?? null,
            'resume' => $resumePath,
            'status' => 'pending',
        ]);

        // Save Skill Answers
        if (isset($validated['answers'])) {
            foreach ($validated['answers'] as $questionId => $answerText) {
                \App\Models\SkillAnswer::create([
                    'skill_question_id' => $questionId,
                    'user_id' => $user->id,
                    'answer' => $answerText,
                ]);
            }
        }

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
            'status' => 'required|in:pending,shortlisted,rejected,hired,accepted',
        ]);

        $application->status = $validated['status'];
        $application->save();

        // Redirect to schedule interview form if status is shortlisted
        if ($application->status === 'shortlisted') {
            return redirect()->route('employer.interviews.schedule.form', $application->id);
        }

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
    // Employer: Accept application
    public function acceptApplication($id)
    {
        $application = Application::findOrFail($id);

        // Only allow employer to accept
        if ($application->job->employer_id !== Auth::id()) {
            abort(403);
        }

        $application->status = 'accepted';
        $application->save();

        // Assign interview session
        InterviewSession::where('job_id', $application->job_id)
            ->whereNull('job_seeker_id')
            ->update([
                'job_seeker_id' => $application->user_id
            ]);

        return back()->with('success', 'Applicant accepted and interview assigned.');
    }

    // Employer: Reject application
    public function rejectApplication($id)
    {
        $application = Application::findOrFail($id);

        // Only allow employer to reject
        if ($application->job->employer_id !== Auth::id()) {
            abort(403);
        }

        $application->status = 'rejected';
        $application->save();

        return back()->with('success', 'Applicant rejected.');
    }

    // Employer: Schedule interview
    public function scheduleInterview(Request $request, Application $application)
    {
        // Only employer can schedule
        if ($application->job->employer_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'scheduled_at' => 'required|date|after:now',
        ]);

        // Create or update interview session
        $session = InterviewSession::updateOrCreate(
            [
                'job_id' => $application->job_id,
                'job_seeker_id' => $application->user_id,
                'application_id' => $application->id,
            ],
            [
                'employer_id' => $application->job->employer_id,
                'scheduled_at' => $validated['scheduled_at'],
                'room_id' => 'room_' . Str::uuid(),
            ]
        );

        // Optionally update application status
        $application->status = 'interview_scheduled';
        $application->save();

        // Send email to job seeker
        Mail::to($application->user->email)->send(new InterviewScheduledMail($session));

        $employerEmail = $application->job->employer?->email;

        if ($employerEmail) {
            Mail::to($employerEmail)->send(new InterviewScheduledMail($session));
        }

        return back()->with('success', 'Interview scheduled and candidate notified.');
    }

    // Show schedule interview form
    public function showScheduleInterviewForm(Application $application)
    {
        // Only employer can access
        if ($application->job->employer_id !== Auth::id()) {
            abort(403);
        }
        return view('employer.interviews.schedule', compact('application'));
    }
}