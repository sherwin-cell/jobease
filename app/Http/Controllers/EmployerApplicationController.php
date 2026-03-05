<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use App\Notifications\InterviewInvitationNotification;

class EmployerApplicationController extends Controller
{
    /**
     * Update application status and notify job seeker.
     */
    public function updateStatus(Request $request, $id)
    {
        $application = Application::findOrFail($id);

        // Update status
        $application->status = $request->status;
        $application->save();

        // Only send interview notification if status is 'Interview'
        if ($request->status === 'Interview') {
            $application->user->notify(
                new InterviewInvitationNotification($application)
            );
        }

        return back()->with('success', 'Status updated and notification sent.');
    }
}