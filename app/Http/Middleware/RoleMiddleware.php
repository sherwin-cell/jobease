<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        $userRoleId = (int) ($user->role_id ?? 0);

        // Roles can be passed either as role_ids (e.g. 3) or role names (e.g. job_seeker).
        $roleIds = [];
        foreach ($roles as $roleParam) {
            $roleParam = trim((string) $roleParam);

            if ($roleParam === '') {
                continue;
            }

            if (is_numeric($roleParam)) {
                $roleIds[] = (int) $roleParam;
                continue;
            }

            $matchedRoleId = Role::where('name', $roleParam)->value('id');
            if ($matchedRoleId !== null) {
                $roleIds[] = (int) $matchedRoleId;
            }
        }

        $roleIds = array_values(array_unique($roleIds));

        if (empty($roleIds) || !in_array($userRoleId, $roleIds, true)) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}