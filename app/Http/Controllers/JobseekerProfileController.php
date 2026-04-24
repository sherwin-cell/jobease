<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobseekerProfile;

class JobseekerProfileController extends Controller
{
    public function show()
    {
        $profile = Auth::user()->jobseekerProfile()
            ->with('user')
            ->first();
        if (!$profile) {
            return redirect()->route('jobseeker.profile.create')
                ->with('info', 'Please complete your profile first.');
        }
        return view('jobseeker.profile.show', compact('profile'));
    }

    public function create()
    {
        $profile = Auth::user()->jobseekerProfile ?? new JobseekerProfile();
        // Ensure education is an array for form binding
        if (empty($profile->education)) {
            $profile->education = [['degree' => '', 'institution' => '', 'field_of_study' => '', 'start_date' => '', 'end_date' => '', 'description' => '']];
        }
        return view('jobseeker.profile.create', compact('profile'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $data = $this->validateData($request);

        $profile = JobseekerProfile::updateOrCreate(
            ['user_id' => $user->id],
            $data
        );

        return redirect()->route('jobseeker.profile.show')->with('success', 'Profile saved!');
    }

    public function edit()
    {
        $profile = Auth::user()->jobseekerProfile;
        // Ensure education is an array for form binding
        if (empty($profile->education)) {
            $profile->education = [['degree' => '', 'institution' => '', 'field_of_study' => '', 'start_date' => '', 'end_date' => '', 'description' => '']];
        }
        return view('jobseeker.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $data = $this->validateData($request);

        $profile = JobseekerProfile::updateOrCreate(
            ['user_id' => $user->id],
            $data
        );

        return redirect()->route('jobseeker.profile.show')->with('success', 'Profile updated!');
    }

    private function validateData(Request $request)
    {
        return $request->validate([
            'headline' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'skills' => 'nullable|array',
            'skills.*' => 'nullable|string|max:255',
            'experience' => 'nullable|array',
            'experience.*.title' => 'nullable|string|max:255',
            'experience.*.company' => 'nullable|string|max:255',
            'experience.*.start_date' => 'nullable|date',
            'experience.*.end_date' => 'nullable|date',
            'experience.*.description' => 'nullable|string',
            'education' => 'nullable|array',
            'education.*.degree' => 'nullable|string|max:255',
            'education.*.institution' => 'nullable|string|max:255',
            'education.*.field_of_study' => 'nullable|string|max:255',
            'education.*.start_date' => 'nullable|date',
            'education.*.end_date' => 'nullable|date',
            'education.*.description' => 'nullable|string',
            'certifications' => 'nullable|array',
            'certifications.*' => 'nullable|string|max:255',
            'interests' => 'nullable|array',
            'interests.*' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'phone' => 'nullable|regex:/^09[0-9]{9}$/',
            'website' => 'nullable|string|max:255',
        ]);
    }
}
