<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployerRegisterController extends Controller
{
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
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => Role::where('name', 'employer')->firstOrFail()->id,
        ]);

        // Create employer profile
        $user->employerProfile()->create([
            'company_name' => $request->company_name,
            'approval_status' => 'pending',
        ]);

        auth()->login($user);
        return redirect()->route('employer.complete-profile');
    }
}
