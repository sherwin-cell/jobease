<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminJobController extends Controller
{
    public function index(Request $request)  // ← ADD $request parameter here
    {
        $query = Job::with('employer.employerProfile');
        
        // Add status filter if provided
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $jobs = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.jobs.index', compact('jobs'));
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

            return redirect()->route('admin.jobs')
                ->with('success', 'Job approved successfully.');

        } catch (\Exception $e) {
            Log::error('Approve error: ' . $e->getMessage());
            return redirect()->route('admin.jobs')
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

            return redirect()->route('admin.jobs')
                ->with('success', 'Job rejected successfully.');

        } catch (\Exception $e) {
            Log::error('Reject error: ' . $e->getMessage());
            return redirect()->route('admin.jobs')
                ->with('error', 'Failed to reject job: ' . $e->getMessage());
        }
    }
}