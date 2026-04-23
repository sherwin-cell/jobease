<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobseekerProfile;

class JobseekerProfileController extends Controller
{
    public function show()
    {
        $profile = Auth::user()->jobseekerProfile;
        if (!$profile) {
            return redirect()->route('jobseeker.profile.create')
                ->with('info', 'Please complete your profile first.');
        }
        return view('jobseeker.profile.show', compact('profile'));
    }

    public function create()
    {
        $profile = Auth::user()->jobseekerProfile ?? new JobseekerProfile();
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
            'education.*.start_date' => 'nullable|date',
            'education.*.end_date' => 'nullable|date',
            'certifications' => 'nullable|array',
            'certifications.*' => 'nullable|string|max:255',
            'interests' => 'nullable|array',
            'interests.*' => 'nullable|string|max:255',
        ]);
    }
}
