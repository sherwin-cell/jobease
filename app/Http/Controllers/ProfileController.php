<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $profile = $user->profile;

        if (!$profile) {
            return redirect()->route('jobseeker.profile.create')
                ->with('info', 'Please complete your profile first.');
        }

        return view('jobseeker.profile.show', compact('profile'));
    }

    // DELETE edit() method — no longer needed

    public function create()
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profile();

        return view('jobseeker.profile.create', compact('profile'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'headline'                => 'nullable|string|max:255',
            'bio'                     => 'nullable|string',
            'location'                => 'nullable|string|max:255',
            'phone'                   => 'nullable|string|max:50',
            'website'                 => 'nullable|url|max:255',
            'skills'                  => 'nullable',
            'certifications'          => 'nullable',
            'interests'               => 'nullable',
            'experience'              => 'nullable|array',
            'experience.*.title'      => 'nullable|string|max:255',
            'experience.*.company'    => 'nullable|string|max:255',
            'experience.*.start_date' => 'nullable|date',
            'experience.*.end_date'   => 'nullable|date',
            'education'               => 'nullable|array',
            'education.*.degree'      => 'nullable|string|max:255',
            'education.*.institution' => 'nullable|string|max:255',
            'education.*.start_date'  => 'nullable|date',
            'education.*.end_date'    => 'nullable|date',
        ]);

        $skills = $request->skills;
        if (is_string($skills)) {
            $skills = array_values(array_filter(array_map('trim', explode(',', $skills))));
        }

        $certifications = $request->certifications;
        if (is_string($certifications)) {
            $certifications = array_values(array_filter(array_map('trim', explode(',', $certifications))));
        }

        $interests = $request->interests;
        if (is_string($interests)) {
            $interests = array_values(array_filter(array_map('trim', explode(',', $interests))));
        }

        Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'headline'       => $request->headline,
                'bio'            => $request->bio,
                'location'       => $request->location,
                'phone'          => $request->phone,
                'website'        => $request->website,
                'skills'         => $skills ?? [],
                'experience'     => $request->experience ?? [],
                'education'      => $request->education ?? [],
                'certifications' => $certifications ?? [],
                'interests'      => $interests ?? [],
            ]
        );

        return redirect()->route('jobseeker.dashboard')
            ->with('success', 'Profile saved successfully!');
    }

    public function update(Request $request)
    {
        return $this->store($request);
    }
}