<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', '!=', 3)->get();
        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // BAN METHOD - This will work
    public function ban(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot ban yourself.');
        }

        if ($user->role_id == 3) {
            return back()->with('error', 'Cannot ban an admin user.');
        }

        $user->is_banned = 1;
        $user->save();

        return back()->with('success', $user->name . ' has been banned successfully.');
    }

    public function unban(User $user)
    {
        $user->is_banned = 0;
        $user->save();

        return back()->with('success', $user->name . ' has been unbanned successfully.');
    }
    // DELETE METHOD - This will work
    public function destroy(User $user)
    {
        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete yourself.');
        }

        // Prevent deleting admin
        if ($user->role_id == 3) {
            return back()->with('error', 'Cannot delete an admin user.');
        }

        $user->delete();

        return back()->with('success', $user->name . ' has been deleted permanently.');
    }
}