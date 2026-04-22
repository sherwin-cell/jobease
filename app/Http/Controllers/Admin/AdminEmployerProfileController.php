<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployerProfile;
use Illuminate\Http\Request;

class AdminEmployerProfileController extends Controller
{
    /**
     * Show pending and approved employer profiles
     */
    public function index()
    {
        $pendingProfiles = EmployerProfile::where('approval_status', 'pending')
            ->with('user')
            ->latest()
            ->paginate(15);

        $approvedProfiles = EmployerProfile::where('approval_status', 'approved')
            ->with(['user', 'approvedByUser'])
            ->latest()
            ->paginate(15);

        return view('admin.employer-profiles.index', compact(
            'pendingProfiles',
            'approvedProfiles'
        ));
    }

    /**
     * Show profile details
     */
    public function show(EmployerProfile $employerProfile)
    {
        $employerProfile->load(['user', 'approvedByUser']);

        return view('admin.employer-profiles.show', compact('employerProfile'));
    }

    /**
     * Approve profile
     */
    public function approve(EmployerProfile $employerProfile)
    {
        if ($employerProfile->approval_status === 'approved') {
            return back()->with('info', 'This profile is already approved.');
        }

        $employerProfile->update([
            'approval_status' => 'approved',
            'approved_at' => now(),
            'approved_by' => auth()->id(),
            'rejection_reason' => null,
        ]);

        return redirect()
            ->route('admin.employer-profiles.index')
            ->with('success', 'Employer profile approved successfully!');
    }

    /**
     * Reject profile
     */
    public function reject(Request $request, EmployerProfile $employerProfile)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        if ($employerProfile->approval_status === 'rejected') {
            return back()->with('info', 'This profile is already rejected.');
        }

        $employerProfile->update([
            'approval_status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
        ]);

        return redirect()
            ->route('admin.employer-profiles.index');
    }

    /**
     * Reset status to pending
     */
    public function resetStatus(EmployerProfile $employerProfile)
    {
        $employerProfile->update([
            'approval_status' => 'pending',
            'rejection_reason' => null,
            'approved_at' => null,
            'approved_by' => null,
        ]);

        return redirect()
            ->route('admin.employer-profiles.index');
    }
}