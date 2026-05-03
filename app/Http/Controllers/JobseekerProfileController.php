<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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

        // Ensure arrays are properly initialized for form binding
        if (empty($profile->education)) {
            $profile->education = [['degree' => '', 'institution' => '', 'field_of_study' => '', 'start_date' => '', 'end_date' => '', 'description' => '']];
        }

        if (empty($profile->experience)) {
            $profile->experience = [['title' => '', 'company' => '', 'start_date' => '', 'end_date' => '', 'description' => '']];
        }

        if (empty($profile->skills)) {
            $profile->skills = [];
        }

        if (empty($profile->certifications)) {
            $profile->certifications = [];
        }

        if (empty($profile->interests)) {
            $profile->interests = [];
        }

        return view('jobseeker.profile.create', compact('profile'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $data = $this->validateData($request);

        // Handle resume upload
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
            $data['resume_path'] = $resumePath;
        }

        // Keep existing resume if no new one uploaded
        $existingProfile = JobseekerProfile::where('user_id', $user->id)->first();
        if (!$request->hasFile('resume') && $existingProfile && $existingProfile->resume_path) {
            $data['resume_path'] = $existingProfile->resume_path;
        }

        $profile = JobseekerProfile::updateOrCreate(
            ['user_id' => $user->id],
            $data
        );

        return redirect()->route('jobseeker.profile.show')
            ->with('success', 'Profile saved successfully!');
    }

    public function edit()
    {
        $profile = Auth::user()->jobseekerProfile;

        if (!$profile) {
            return redirect()->route('jobseeker.profile.create')
                ->with('info', 'Please create your profile first.');
        }

        // Ensure arrays are properly initialized for form binding
        if (empty($profile->education)) {
            $profile->education = [['degree' => '', 'institution' => '', 'field_of_study' => '', 'start_date' => '', 'end_date' => '', 'description' => '']];
        }

        if (empty($profile->experience)) {
            $profile->experience = [['title' => '', 'company' => '', 'start_date' => '', 'end_date' => '', 'description' => '']];
        }

        if (empty($profile->skills)) {
            $profile->skills = [];
        }

        if (empty($profile->certifications)) {
            $profile->certifications = [];
        }

        if (empty($profile->interests)) {
            $profile->interests = [];
        }

        return view('jobseeker.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $data = $this->validateData($request);

        // Handle resume upload
        if ($request->hasFile('resume')) {
            // Delete old resume if exists
            $existingProfile = JobseekerProfile::where('user_id', $user->id)->first();
            if ($existingProfile && $existingProfile->resume_path) {
                Storage::disk('public')->delete($existingProfile->resume_path);
            }

            $resumePath = $request->file('resume')->store('resumes', 'public');
            $data['resume_path'] = $resumePath;
        }

        $profile = JobseekerProfile::updateOrCreate(
            ['user_id' => $user->id],
            $data
        );

        return redirect()->route('jobseeker.profile.show')
            ->with('success', 'Profile updated successfully!');
    }

    private function validateData(Request $request)
    {
        // Get raw input values
        $skills = $request->input('skills');
        $certifications = $request->input('certifications');
        $interests = $request->input('interests');

        // Convert to array if they are JSON strings
        if (is_string($skills)) {
            $decoded = json_decode($skills, true);
            $skills = is_array($decoded) ? $decoded : [];
            $request->merge(['skills' => $skills]);
        }

        if (is_string($certifications)) {
            $decoded = json_decode($certifications, true);
            $certifications = is_array($decoded) ? $decoded : [];
            $request->merge(['certifications' => $certifications]);
        }

        if (is_string($interests)) {
            $decoded = json_decode($interests, true);
            $interests = is_array($decoded) ? $decoded : [];
            $request->merge(['interests' => $interests]);
        }

        // If still empty, set as empty arrays
        if (empty($request->skills)) {
            $request->merge(['skills' => []]);
        }
        if (empty($request->certifications)) {
            $request->merge(['certifications' => []]);
        }
        if (empty($request->interests)) {
            $request->merge(['interests' => []]);
        }

        // Now validate
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
            'phone' => 'nullable|string|regex:/^09[0-9]{9}$/',
            'website' => 'nullable|url|max:255',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);
    }
}