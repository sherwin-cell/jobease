<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureEmployerProfileComplete
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Only check for authenticated employers
        if ($user && $user->isEmployer()) {

            // If no profile exists
            if (!$user->employerProfile) {
                return redirect()->route('employer.complete-profile')
                    ->with('info', 'Please complete your company profile first.');
            }

            // ✅ CRITICAL: If profile is approved, let them through IMMEDIATELY
            if ($user->employerProfile->approval_status === 'approved') {
                return $next($request);
            }

            // Check if profile has required fields
            if (!$user->employerProfile->company_name || 
                !$user->employerProfile->business_permit_path) {
                return redirect()->route('employer.complete-profile')
                    ->with('info', 'Please complete your company profile first.');
            }

            // For pending status - only allow specific routes
            if ($user->employerProfile->approval_status === 'pending') {
                $currentRoute = $request->route()->getName();
                
                // Allowed routes for pending profiles
                $allowedRoutes = [
                    'employer.profile-pending',
                    'employer.profile.edit',
                    'employer.profile.update',
                    'employer.complete-profile',
                ];
                
                // If not on an allowed route, redirect to pending page
                if (!in_array($currentRoute, $allowedRoutes)) {
                    return redirect()->route('employer.profile-pending');
                }
                
                // If already on pending page, let them see it
                return $next($request);
            }

            // For rejected status
            if ($user->employerProfile->approval_status === 'rejected') {
                return redirect()->route('employer.complete-profile')
                    ->with('error', 'Your profile was rejected. Please update and resubmit.');
            }
        }

        return $next($request);
    }
}