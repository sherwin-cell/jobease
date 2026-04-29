<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Show registration form
    public function showRegistrationForm()
    {
        // Only allow Job Seeker and Employer (not Admin)
        $roles = Role::whereIn('id', [1, 2])->get();
        return view('auth.register', compact('roles'));
    }

    // Handle registration form submission
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'unique:users',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/@gmail\.com$/i', $value)) {
                        $fail('Only @gmail.com emails are allowed to register.');
                    }
                },
            ],
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|in:1,2', // Only Job Seeker or Employer
            'company_name' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => (int) $request->role_id, // force integer
            'password' => Hash::make($request->password),
        ]);

        // Send email verification link
        //$user->sendEmailVerificationNotification();

        // If employer, create employer profile
        if ($user->isEmployer()) {
            $user->employerProfile()->create([
                'company_name' => $request->company_name,
            ]);
        }

        Auth::login($user);

        if ($user->isJobSeeker()) {
            return redirect()->route('jobseeker.dashboard');
        } elseif ($user->isEmployer()) {
            return redirect()->route('employer.dashboard');
        } else {
            abort(403, 'Unauthorized');
        }
    }
}