<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $user = auth()->user();

        $roleIds = collect($roles)->map(function ($role) {
            if (is_numeric($role)) {
                return (int) $role;
            }

            return \App\Models\Role::where('name', $role)->value('id');
        })->filter()->toArray();

        if (!in_array($user->role_id, $roleIds)) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}