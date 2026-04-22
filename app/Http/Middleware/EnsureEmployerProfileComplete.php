<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureEmployerProfileComplete
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Only check for authenticated employers
        if ($user && $user->isEmployer()) {

            // If profile doesn't exist OR is not complete
            if (!$user->employerProfile || !$user->employerProfile->is_complete) {
                return redirect()->route('employer.complete-profile');
            }

            // If profile is not approved
            if (!$user->employerProfile->isApproved()) {
                return redirect()->route('employer.profile-pending');
            }
        }

        return $next($request);
    }
}