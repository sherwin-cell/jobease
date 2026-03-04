<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Skill;
use App\Models\Certification;
use App\Models\Interest;

class ProfileController extends Controller
{
    // Show the profile edit form
    public function edit()
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profile();

        $skills = Skill::all(); // pre-defined skills list

        return view('jobseeker.profile.edit', compact('profile', 'skills'));
    }

    // Update the profile
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate main profile
        $request->validate([
            'headline' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'website' => 'nullable|url|max:255',
            'skills' => 'nullable|array',
            'skills.*' => 'exists:skills,id',
        ]);

        // Create or update profile
        $profile = $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $request->only(['headline', 'bio', 'location', 'phone', 'website'])
        );

        // Sync skills (many-to-many)
        if ($request->filled('skills')) {
            $profile->skills()->sync($request->skills);
        }

        // -----------------------------
        // Handle Experiences
        // -----------------------------
        if ($request->filled('experiences')) {
            $profile->experiences()->delete(); // simple approach: delete old entries
            foreach ($request->experiences as $exp) {
                $profile->experiences()->create($exp);
            }
        }

        // -----------------------------
        // Handle Education
        // -----------------------------
        if ($request->filled('educations')) {
            $profile->educations()->delete();
            foreach ($request->educations as $edu) {
                $profile->educations()->create($edu);
            }
        }

        // -----------------------------
        // Handle Certifications
        // -----------------------------
        if ($request->filled('certifications')) {
            $profile->certifications()->delete();
            foreach ($request->certifications as $cert) {
                $profile->certifications()->create($cert);
            }
        }

        // -----------------------------
        // Handle Interests
        // -----------------------------
        if ($request->filled('interests')) {
            $profile->interests()->delete();
            foreach ($request->interests as $interest) {
                $profile->interests()->create($interest);
            }
        }

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
}