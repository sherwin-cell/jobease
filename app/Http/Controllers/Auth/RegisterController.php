<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Traits\LogsActivity;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    use LogsActivity;

    public function showRegistrationForm()
    {
        $roles = Role::whereIn('id', [1, 2])->get();
        return view('auth.register', compact('roles'));
    }

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
            'role_id' => 'required|in:1,2',
            'company_name' => 'nullable|string|max:255',
            'terms' => 'required|accepted',
        ], [
            'terms.accepted' => 'You must agree to the Terms of Service and Privacy Policy.',
            'terms.required' => 'Please accept the Terms of Service and Privacy Policy to continue.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => (int) $request->role_id,
            'password' => Hash::make($request->password),
        ]);

        // Refresh the user to ensure it's fully saved
        $user = $user->fresh();

        // Send email verification link using Laravel's event system
        event(new Registered($user));

        // Create profile based on role
        if ($user->isJobSeeker()) {
            // Create empty job seeker profile
            $user->jobseekerProfile()->create([]);

            // Log the registration
            ActivityLog::create([
                'user_id' => $user->id,
                'action' => 'New Account Created',
                'description' => "New Job Seeker registered: {$user->name} ({$user->email})",
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }

        if ($user->isEmployer()) {
            // Create employer profile with company name
            $user->employerProfile()->create([
                'company_name' => $request->company_name,
                'approval_status' => 'pending',
                'is_complete' => false,
            ]);

            // Log the registration
            ActivityLog::create([
                'user_id' => $user->id,
                'action' => 'New Account Created',
                'description' => "New Employer registered: {$user->name} - Company: {$request->company_name} ({$user->email})",
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }

        // Login the user
        Auth::login($user);

        // Redirect based on role
        if ($user->isJobSeeker()) {
            $profile = $user->jobseekerProfile;
            $needsCompletion = !$profile || empty($profile->headline) || empty($profile->skills);

            if ($needsCompletion) {
                return redirect()->route('jobseeker.profile.edit')
                    ->with('info', 'Please complete your profile. A verification link has been sent to your email.');
            }

            return redirect()->route('jobseeker.dashboard')
                ->with('info', 'Please verify your email address. A verification link has been sent to your email.');
        }

        if ($user->isEmployer()) {
            $profile = $user->employerProfile;
            $needsCompletion = !$profile || empty($profile->company_name) || $profile->approval_status == 'pending';

            if ($needsCompletion) {
                return redirect()->route('employer.complete-profile')
                    ->with('info', 'Please complete your company profile. A verification link has been sent to your email.');
            }

            return redirect()->route('employer.dashboard')
                ->with('info', 'Please verify your email address. A verification link has been sent to your email.');
        }

        // Fallback for admin
        return redirect()->route('admin.dashboard')
            ->with('info', 'Please verify your email address. A verification link has been sent to your email.');
    }
}