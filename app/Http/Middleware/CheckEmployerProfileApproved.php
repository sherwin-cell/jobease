<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckEmployerProfileApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Only check for authenticated employers
        if ($user && $user->isEmployer()) {

            // If profile doesn't exist
            if (!$user->employerProfile) {
                return redirect()->route('employer.complete-profile')
                    ->with('error', 'Please complete your company profile first.');
            }

            // If profile is not complete
            if (!$user->employerProfile->is_complete) {
                return redirect()->route('employer.complete-profile')
                    ->with('info', 'Please complete your company profile first.');
            }

            // Check approval status
            if ($user->employerProfile->approval_status === 'pending') {
                return redirect()->route('employer.profile-pending')
                    ->with('info', 'Your profile is pending admin approval.');
            }

            if ($user->employerProfile->approval_status === 'rejected') {
                return redirect()->route('employer.complete-profile')
                    ->with('error', 'Your profile was rejected. Reason: ' . ($user->employerProfile->rejection_reason ?? 'No reason provided'));
            }

            if ($user->employerProfile->approval_status !== 'approved') {
                return redirect()->route('employer.profile-pending')
                    ->with('info', 'Your profile is pending admin approval.');
            }
        }

        return $next($request);
    }
}