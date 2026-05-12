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

class EmployerRegisterController extends Controller
{
    use LogsActivity;
    
    public function showRegistrationForm()
    {
        return view('auth.employer-register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users',
                function ($attribute, $value, $fail) {
                    if (!preg_match('/@gmail\.com$/i', $value)) {
                        $fail('Only @gmail.com emails are allowed to register.');
                    }
                },
            ],
            'password' => 'required|string|min:8|confirmed',
            'company_name' => 'required|string|max:255',
            'terms' => 'required|accepted',
        ], [
            'terms.accepted' => 'You must agree to the Terms of Service and Privacy Policy.',
            'terms.required' => 'Please accept the Terms of Service and Privacy Policy to continue.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => Role::where('name', 'employer')->firstOrFail()->id,
        ]);

        // Refresh the user to ensure it's fully saved
        $user = $user->fresh();

        // Create employer profile
        $user->employerProfile()->create([
            'company_name' => $request->company_name,
            'approval_status' => 'pending',
            'is_complete' => false,
        ]);

        // Send email verification via Laravel's built-in system
        event(new Registered($user));

        // Log the registration
        ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'New Account Created',
            'description' => "New Employer registered: {$user->name} - Company: {$request->company_name} ({$user->email})",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Login the user
        Auth::login($user);

        // Redirect to complete profile page
        return redirect()->route('employer.complete-profile')
            ->with('info', 'Please complete your company profile. A verification link has been sent to your email.');
    }
}