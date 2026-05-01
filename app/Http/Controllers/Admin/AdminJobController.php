<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminJobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('employer.employerProfile')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('admin.jobs.index', compact('jobs'));
    }

    public function approve(Job $job)
    {
        try {
            Log::info('=== APPROVE JOB ATTEMPT ===');
            Log::info('Job ID: ' . $job->id);
            Log::info('Current status: ' . $job->status);
            
            // Method 1: Try update()
            $result = $job->update(['status' => 'active']);
            Log::info('Update result: ' . ($result ? 'true' : 'false'));
            
            // Method 2: Check if it actually updated
            $freshJob = Job::find($job->id);
            Log::info('New status after update: ' . $freshJob->status);
            
            if ($freshJob->status !== 'active') {
                // Method 3: Force update using DB
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
            
            // Method 1: Try update()
            $result = $job->update(['status' => 'rejected']);
            Log::info('Update result: ' . ($result ? 'true' : 'false'));
            
            // Method 2: Check if it actually updated
            $freshJob = Job::find($job->id);
            Log::info('New status after update: ' . $freshJob->status);
            
            if ($freshJob->status !== 'rejected') {
                // Method 3: Force update using DB
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