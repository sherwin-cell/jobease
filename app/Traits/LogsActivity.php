<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    /**
     * Write an activity log entry for the currently authenticated user.
     *
     * Usage inside any controller that uses this trait:
     *   $this->logActivity('Job Posted', 'Software Engineer at Manila', jobId: $job->id);
     */
    protected function logActivity(
        string   $action,
        string   $description,
        ?int     $jobId = null
    ): void {
        ActivityLog::create([
            'user_id'     => Auth::id(),
            'action'      => $action,
            'description' => $description,
            'job_id'      => $jobId,
            'ip_address'  => request()->ip(),
            'user_agent'  => request()->userAgent(),
        ]);
    }
}