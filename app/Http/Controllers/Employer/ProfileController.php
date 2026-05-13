<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $company = $user->employerProfile ?? new \App\Models\EmployerProfile(['user_id' => $user->id]);
        
        return view('employer.profile.edit', compact('company'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'website' => 'nullable|url|max:255',
            'description' => 'required|string',
            'business_permit_path' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120', // Changed to match database
        ]);

        $profile = $user->employerProfile;

        if (!$profile) {
            $profile = new \App\Models\EmployerProfile();
            $profile->user_id = $user->id;
            $profile->approval_status = 'pending';
        }

        // Update basic info
        $profile->company_name = $validated['company_name'];
        $profile->location = $validated['location'];
        $profile->phone = $validated['phone'];
        $profile->website = $validated['website'] ?? null;
        $profile->description = $validated['description'];

        // Handle business permit upload - using 'business_permit_path'
        if ($request->hasFile('business_permit_path')) { // Changed to match form input
            // Delete old file if exists
            if ($profile->business_permit_path) {
                Storage::disk('public')->delete($profile->business_permit_path);
            }
            
            $path = $request->file('business_permit_path')->store('business_permits', 'public'); // Changed to match
            $profile->business_permit_path = $path;
        }

        // Only set pending if NOT already approved
        if ($profile->approval_status !== 'approved') {
            $profile->approval_status = 'pending';
        }

        $profile->save();

        if ($profile->approval_status === 'approved') {
            return redirect()->route('employer.profile.edit', ['edit' => 0])
                ->with('success', 'Profile updated successfully!');
        }

        return redirect()->route('employer.profile-pending')
            ->with('success', 'Profile submitted! Waiting for admin approval.');
    }
}