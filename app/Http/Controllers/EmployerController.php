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
        $company = auth()->user()->profile ?? new \App\Models\Profile(['user_id' => auth()->id()]);
        return view('employer.edit_profile', compact('company'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'website' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        auth()->user()->profile()->updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'headline' => $request->company_name,
                'website' => $request->website,
                'bio' => $request->description,
            ]
        );

        return redirect()->route('employer.dashboard')->with('success', 'Profile updated.');
    }
}