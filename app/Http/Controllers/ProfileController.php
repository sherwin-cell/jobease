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
            'headline'                        => 'nullable|string|max:255',
            'bio'                             => 'nullable|string',
            'location'                        => 'nullable|string|max:255',
            'phone'                           => 'nullable|string|max:50',
            'website'                         => 'nullable|url|max:255',
            'skills'                          => 'nullable|array',
            'skills.*'                        => 'nullable|string|max:100',
            'interests'                       => 'nullable|array',
            'interests.*'                     => 'nullable|string|max:100',

            'experience'                      => 'nullable|array',
            'experience.*.title'              => 'required_with:experience|string|max:255',
            'experience.*.company'            => 'required_with:experience|string|max:255',
            'experience.*.start_date'         => 'required_with:experience|date',
            'experience.*.current_job'        => 'nullable|boolean',
            'experience.*.end_date'           => 'nullable|date|after_or_equal:experience.*.start_date',
            'experience.*.description'        => 'nullable|string|max:2000',

            'education'                       => 'nullable|array',
            'education.*.degree'              => 'required_with:education|string|max:255',
            'education.*.school'              => 'required_with:education|string|max:255',
            'education.*.field_of_study'      => 'nullable|string|max:255',
            'education.*.start_date'          => 'required_with:education|date',
            'education.*.end_date'            => 'nullable|date|after_or_equal:education.*.start_date',

            'certifications'                  => 'nullable|array',
            'certifications.*.name'           => 'required_with:certifications|string|max:255',
            'certifications.*.issuing_org'    => 'nullable|string|max:255',
            'certifications.*.issue_date'     => 'nullable|date',
            'certifications.*.expiration_date'=> 'nullable|date|after_or_equal:certifications.*.issue_date',
        ]);

        // Clean up simple string arrays
        $skills = array_values(array_filter(
            array_map('trim', $request->input('skills', [])),
            fn($v) => $v !== ''
        ));

        $interests = array_values(array_filter(
            array_map('trim', $request->input('interests', [])),
            fn($v) => $v !== ''
        ));

        // Process experience: clear end_date when current_job is checked, then sort most recent first
        $experience = [];
        foreach ($request->input('experience', []) as $exp) {
            if (empty($exp['title']) && empty($exp['company'])) {
                continue;
            }
            $isCurrentJob = !empty($exp['current_job']);
            $experience[] = [
                'title'       => trim($exp['title'] ?? ''),
                'company'     => trim($exp['company'] ?? ''),
                'start_date'  => $exp['start_date'] ?? null,
                'end_date'    => $isCurrentJob ? null : ($exp['end_date'] ?? null),
                'current_job' => $isCurrentJob,
                'description' => trim($exp['description'] ?? ''),
            ];
        }
        usort($experience, fn($a, $b) => strcmp($b['start_date'] ?? '', $a['start_date'] ?? ''));

        // Process education, sort most recent first
        $education = [];
        foreach ($request->input('education', []) as $edu) {
            if (empty($edu['degree']) && empty($edu['school'])) {
                continue;
            }
            $education[] = [
                'degree'         => trim($edu['degree'] ?? ''),
                'school'         => trim($edu['school'] ?? ''),
                'field_of_study' => trim($edu['field_of_study'] ?? ''),
                'start_date'     => $edu['start_date'] ?? null,
                'end_date'       => $edu['end_date'] ?? null,
            ];
        }
        usort($education, fn($a, $b) => strcmp($b['start_date'] ?? '', $a['start_date'] ?? ''));

        // Process certifications
        $certifications = [];
        foreach ($request->input('certifications', []) as $cert) {
            if (empty($cert['name'])) {
                continue;
            }
            $certifications[] = [
                'name'            => trim($cert['name']),
                'issuing_org'     => trim($cert['issuing_org'] ?? ''),
                'issue_date'      => $cert['issue_date'] ?? null,
                'expiration_date' => $cert['expiration_date'] ?? null,
            ];
        }

        Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'headline'       => $request->headline,
                'bio'            => $request->bio,
                'location'       => $request->location,
                'phone'          => $request->phone,
                'website'        => $request->website,
                'skills'         => $skills,
                'experience'     => $experience,
                'education'      => $education,
                'certifications' => $certifications,
                'interests'      => $interests,
            ]
        );

        return redirect()->route('jobseeker.profile.show')
            ->with('success', 'Profile saved successfully!');
    }

    public function update(Request $request)
    {
        return $this->store($request);
    }
}