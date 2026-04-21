<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureEmployerProfileComplete
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

        // Check if the user is an employer and their company profile is incomplete
        if ($user && $user->role === 'employer' && !$user->profile->isCompanyProfileComplete()) {
            return redirect()->route('employer.complete-profile');
        }

        return $next($request);
    }
}