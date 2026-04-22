<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            'business_permit' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $data = [
            'company_name' => $request->company_name,
            'website' => $request->website,
            'description' => $request->description,
            'location' => $request->location,
            'phone' => $request->phone,
        ];

        if ($request->hasFile('business_permit')) {
            $data['business_permit'] = $request->file('business_permit')->store('business_permits', 'public');
        }

        $profile = auth()->user()->employerProfile()->updateOrCreate(
            ['user_id' => auth()->id()],
            $data
        );

        if ($profile->is_complete) {
            return redirect()->route('employer.dashboard')
                ->with('success', 'Profile completed successfully!');
        }

        return redirect()->back()->with('info', 'Please complete all required fields to access the dashboard.');
    }
}