<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $user = auth()->user();

        if ($user->is_banned) {
            auth()->logout();
            return redirect('/login')->withErrors([
                'email' => 'Your account has been banned.'
            ]);
        }
        // Convert role names → role IDs
        $roleIds = collect($roles)
            ->map(function ($role) {
                // If numeric (like 1,2,3)
                if (is_numeric($role)) {
                    return (int) $role;
                }

                // If string role (job_seeker, employer, admin)
                return Role::where('name', $role)->value('id');
            })
            ->filter()
            ->values()
            ->toArray();

        // Check access
        if (!in_array($user->role_id, $roleIds)) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}