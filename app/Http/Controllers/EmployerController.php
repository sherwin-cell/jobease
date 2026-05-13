<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployerController extends Controller
{
    public function dashboard()
    {
        return view('dashboards.employer');
    }

    public function editProfile()
    {
        $company = auth()->user()->employerProfile ?? new \App\Models\EmployerProfile(['user_id' => auth()->id()]);
        return view('employer.edit_profile', compact('company'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'website' => 'nullable|url',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'business_permit_path' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $user = auth()->user();
        $profile = $user->employerProfile;
        
        if (!$profile) {
            $profile = new \App\Models\EmployerProfile();
            $profile->user_id = $user->id;
        }
        
        // Update basic info
        $profile->company_name = $request->company_name;
        $profile->website = $request->website;
        $profile->description = $request->description;
        $profile->location = $request->location;
        $profile->phone = $request->phone;
        
        // Handle business permit upload
        if ($request->hasFile('business_permit')) {
            // Delete old file if exists
            if ($profile->business_permit) {
                Storage::disk('public')->delete($profile->business_permit);
            }
            
            $path = $request->file('business_permit')->store('business_permits', 'public');
            $profile->business_permit = $path;
        }
        
        // REMOVE THIS LINE - it's causing the error
        // $profile->is_complete = true;
        
        $profile->approval_status = 'pending';
        $profile->save();

        return redirect()->route('employer.profile-pending')
            ->with('success', 'Profile submitted successfully! Waiting for admin approval.');
    }
}