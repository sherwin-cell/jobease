<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminJobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::with('employer.employerProfile');
        
        // Add status filter if provided
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $jobs = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.jobs.index', compact('jobs'));
    }

    // For viewing a single job
    public function show(Job $job)
    {
        $job->load(['employer.employerProfile', 'applications.user']);
        return view('admin.jobs.show', compact('job'));
    }

    // For deleting a job
    public function destroy(Job $job)
    {
        try {
            // Delete associated applications first
            $job->applications()->delete();
            
            // Delete the job
            $job->delete();

            return redirect()->route('admin.jobs.index')
                ->with('success', 'Job deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Job delete error: ' . $e->getMessage());
            return redirect()->route('admin.jobs.index')
                ->with('error', 'Failed to delete job: ' . $e->getMessage());
        }
    }

    // For closing a job
    public function close(Job $job)
    {
        try {
            if ($job->status !== 'active') {
                return redirect()->route('admin.jobs.index')
                    ->with('error', 'Only active jobs can be closed.');
            }

            $job->status = 'closed';
            $job->save();

            return redirect()->route('admin.jobs.index')
                ->with('success', 'Job closed successfully.');

        } catch (\Exception $e) {
            Log::error('Close job error: ' . $e->getMessage());
            return redirect()->route('admin.jobs.index')
                ->with('error', 'Failed to close job: ' . $e->getMessage());
        }
    }

    // For bulk actions
    public function bulkAction(Request $request)
    {
        $request->validate([
            'job_ids' => 'required|array',
            'job_ids.*' => 'exists:jobs,id',
            'action' => 'required|in:approve,reject,delete,close',
        ]);

        try {
            $jobs = Job::whereIn('id', $request->job_ids);
            
            switch ($request->action) {
                case 'approve':
                    $jobs->update(['status' => 'active']);
                    $message = 'Jobs approved successfully.';
                    break;
                case 'reject':
                    $jobs->update(['status' => 'rejected']);
                    $message = 'Jobs rejected successfully.';
                    break;
                case 'close':
                    $jobs->update(['status' => 'closed']);
                    $message = 'Jobs closed successfully.';
                    break;
                case 'delete':
                    foreach ($jobs->get() as $job) {
                        $job->applications()->delete();
                        $job->delete();
                    }
                    $message = 'Jobs deleted successfully.';
                    break;
            }

            return redirect()->route('admin.jobs.index')
                ->with('success', $message);

        } catch (\Exception $e) {
            Log::error('Bulk action error: ' . $e->getMessage());
            return redirect()->route('admin.jobs.index')
                ->with('error', 'Failed to perform bulk action: ' . $e->getMessage());
        }
    }

    public function approve(Job $job)
    {
        try {
            Log::info('=== APPROVE JOB ATTEMPT ===');
            Log::info('Job ID: ' . $job->id);
            Log::info('Current status: ' . $job->status);

            // Direct update - simpler approach
            $job->status = 'active';
            $result = $job->save();
            
            Log::info('Update result: ' . ($result ? 'true' : 'false'));
            Log::info('New status: ' . $job->fresh()->status);

            if (!$result || $job->fresh()->status !== 'active') {
                // Force update using DB if save() fails
                DB::table('jobs')->where('id', $job->id)->update(['status' => 'active']);
                Log::info('Forced DB update executed');
            }

            return redirect()->route('admin.jobs.index')
                ->with('success', 'Job approved successfully.');

        } catch (\Exception $e) {
            Log::error('Approve error: ' . $e->getMessage());
            return redirect()->route('admin.jobs.index')
                ->with('error', 'Failed to approve job: ' . $e->getMessage());
        }
    }

    public function reject(Job $job)
    {
        try {
            Log::info('=== REJECT JOB ATTEMPT ===');
            Log::info('Job ID: ' . $job->id);
            Log::info('Current status: ' . $job->status);

            // Direct update - simpler approach
            $job->status = 'rejected';
            $result = $job->save();
            
            Log::info('Update result: ' . ($result ? 'true' : 'false'));
            Log::info('New status: ' . $job->fresh()->status);

            if (!$result || $job->fresh()->status !== 'rejected') {
                // Force update using DB if save() fails
                DB::table('jobs')->where('id', $job->id)->update(['status' => 'rejected']);
                Log::info('Forced DB update executed');
            }

            return redirect()->route('admin.jobs.index')
                ->with('success', 'Job rejected successfully.');

        } catch (\Exception $e) {
            Log::error('Reject error: ' . $e->getMessage());
            return redirect()->route('admin.jobs.index')
                ->with('error', 'Failed to reject job: ' . $e->getMessage());
        }
    }
}