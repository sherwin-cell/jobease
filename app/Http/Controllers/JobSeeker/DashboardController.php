<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use App\Models\Job;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Check if profile exists
        if (!$user->jobseekerProfile) {
            return redirect()->route('jobseeker.profile.create')
                ->with('info', 'Please complete your profile first.');
        }

        // Get applications count
        $applicationsCount = Application::where('user_id', $user->id)->count();

        // Get under review count (applications with status 'pending' or 'reviewing')
        $underReviewCount = Application::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'reviewing'])
            ->count();

        // Get interviews count
        // Get interviews count (include both 'interview' and 'interview_scheduled')
        $interviewsCount = Application::where('user_id', $user->id)
            ->whereIn('status', ['interview', 'interview_scheduled'])
            ->count();

        // Get recommended jobs (active jobs not applied to)
        $appliedJobIds = Application::where('user_id', $user->id)->pluck('job_id')->toArray();

        $recommendedJobs = Job::where('status', 'active')
            ->whereNotIn('id', $appliedJobIds)
            ->with('employer.employerProfile')
            ->latest()
            ->take(3)
            ->get();

        // Get recent applications
        $recentApplications = Application::where('user_id', $user->id)
            ->with('job.employer.employerProfile')
            ->latest()
            ->take(5)
            ->get();

        // Calculate profile completion
        $profile = $user->jobseekerProfile;
        $profileCompletion = $this->calculateProfileCompletion($profile);

        return view('dashboards.jobseeker', compact(
            'applicationsCount',
            'underReviewCount',
            'interviewsCount',
            'recommendedJobs',
            'recentApplications',
            'profileCompletion'
        ));
    }

    private function calculateProfileCompletion($profile)
    {
        if (!$profile) {
            return 0;
        }

        $completionData = [
            'headline' => [
                'filled' => !empty($profile->headline),
                'weight' => 1
            ],
            'bio' => [
                'filled' => !empty($profile->bio),
                'weight' => 1
            ],
            'phone' => [
                'filled' => !empty($profile->phone),
                'weight' => 1
            ],
            'location' => [
                'filled' => !empty($profile->location),
                'weight' => 1
            ],
            'skills' => [
                'filled' => !empty($profile->skills) && count($profile->skills) > 0,
                'weight' => 2
            ],
            'experience' => [
                'filled' => !empty($profile->experience) && count($profile->experience) > 0,
                'weight' => 2
            ],
            'education' => [
                'filled' => !empty($profile->education) && count($profile->education) > 0,
                'weight' => 2
            ],
            // ADD THESE - THEY ARE MISSING!
            'certifications' => [
                'filled' => !empty($profile->certifications) && count($profile->certifications) > 0,
                'weight' => 1
            ],
            'interests' => [
                'filled' => !empty($profile->interests) && count($profile->interests) > 0,
                'weight' => 1
            ],
            'website' => [
                'filled' => !empty($profile->website),
                'weight' => 1
            ],
            'resume' => [
                'filled' => !empty($profile->resume_path),
                'weight' => 2
            ],
        ];

        $totalWeight = array_sum(array_column($completionData, 'weight'));
        $earnedWeight = 0;

        foreach ($completionData as $item) {
            if ($item['filled']) {
                $earnedWeight += $item['weight'];
            }
        }

        return round(($earnedWeight / $totalWeight) * 100);
    }
}