<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        $existingUser = User::where('email', $googleUser->getEmail())->first();

        if ($existingUser) {
            // Already registered, just login
            $existingUser->update([
                'google_id' => $googleUser->getId(),
                'avatar'    => $googleUser->getAvatar(),
            ]);
            Auth::login($existingUser);
            return $this->redirectByRole($existingUser);
        }

        // New user - store google data in session and ask for role
        session([
            'google_user' => [
                'name'   => $googleUser->getName(),
                'email'  => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
            ]
        ]);

        return redirect()->route('google.select.role');
    }

    public function showRoleSelect()
    {
        if (!session('google_user')) {
            return redirect()->route('login');
        }

        return view('auth.google-role-select');
    }

    public function storeRole(Request $request)
    {
        $request->validate([
            'role' => 'required|in:job_seeker,employer',
        ]);

        $googleData = session('google_user');

        if (!$googleData) {
            return redirect()->route('login');
        }

        $role = Role::where('name', $request->role)->first();

        $user = User::create([
            'name'              => $googleData['name'],
            'email'             => $googleData['email'],
            'google_id'         => $googleData['google_id'],
            'avatar'            => $googleData['avatar'],
            'password'          => bcrypt(str()->random(24)),
            'email_verified_at' => now(),
            'role_id'           => $role->id,
        ]);

        session()->forget('google_user');

        Auth::login($user);

        return $this->redirectByRole($user);
    }

    private function redirectByRole(User $user)
    {
        if ($user->isJobSeeker()) {
            $profile = $user->jobseekerProfile;
            $needsCompletion = !$profile || empty($profile->headline);

            if ($needsCompletion) {
                return redirect()->route('jobseeker.profile.edit')
                    ->with('success', 'Welcome to JobEase! Please complete your profile.');
            }
            return redirect()->route('jobseeker.dashboard')
                ->with('success', 'Welcome back!');
        }

        if ($user->isEmployer()) {
            if (!$user->employerProfile || !$user->employerProfile->is_complete) {
                return redirect()->route('employer.complete-profile')
                    ->with('success', 'Welcome! Please complete your company profile.');
            }
            return redirect()->route('employer.dashboard')
                ->with('success', 'Welcome back!');
        }

        return redirect('/dashboard');
    }
}