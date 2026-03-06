<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\Skill;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $profile = $user->profile;

        if (!$profile) {
            return redirect()->route('profile.edit')->with('info', 'Please complete your profile first.');
        }

        return view('jobseeker.profile.show', compact('profile'));
    }

    public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profile();

        // Predefined skills (if you have a skills table)
        $skills = Skill::all();

        return view('jobseeker.profile.edit', compact('profile', 'skills'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'headline' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'website' => 'nullable|url|max:255',
            'skills' => 'nullable|array',
            'skills.*' => 'integer|exists:skills,id',
            'experience' => 'nullable|array',
            'education' => 'nullable|array',
            'certifications' => 'nullable|array',
            'interests' => 'nullable|array',
        ]);

        $profile = $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $request->only(['headline', 'bio', 'location', 'phone', 'website'])
        );

        // Sync skills (many-to-many pivot)
        $skillIds = collect($request->input('skills', []))
            ->filter(fn ($id) => is_numeric($id))
            ->map(fn ($id) => (int) $id)
            ->filter(fn ($id) => $id > 0)
            ->unique()
            ->values()
            ->all();

        $profile->skills()->sync($skillIds);

        // Handle Experiences (one-to-many)
        $profile->experiences()->delete();
        foreach ($request->experience ?? [] as $exp) {
            $profile->experiences()->create($exp);
        }

        // Handle Education (one-to-many)
        $profile->educations()->delete();
        foreach ($request->education ?? [] as $edu) {
            $profile->educations()->create($edu);
        }

        // Handle Certifications (one-to-many)
        $profile->certifications()->delete();
        foreach ($request->certifications ?? [] as $cert) {
            $profile->certifications()->create(['name' => $cert]);
        }

        // Handle Interests (one-to-many)
        $profile->interests()->delete();
        foreach ($request->interests ?? [] as $interest) {
            $profile->interests()->create(['name' => $interest]);
        }
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
}