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
        $roles = Role::whereIn('name', ['job_seeker', 'employer'])->get();
        return view('auth.register', compact('roles'));
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
        ]);

        // Auto-login
        Auth::login($user);

        // Redirect based on role
        if ($user->isJobSeeker()) {
            return redirect()->route('jobseeker.dashboard');
        } elseif ($user->isEmployer()) {
            return redirect()->route('employer.dashboard');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }
}