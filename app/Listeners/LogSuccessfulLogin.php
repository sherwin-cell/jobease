<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class LogSuccessfulLogin
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(Login $event): void
    {
        $user = $event->user;
        
        // Check if this is immediately after registration (within 5 seconds)
        $recentRegistration = ActivityLog::where('user_id', $user->id)
            ->where('action', 'New Account Created')
            ->where('created_at', '>', now()->subSeconds(10))
            ->exists();
        
        // If just registered, don't log the auto-login
        if ($recentRegistration) {
            return;
        }
        
        // Prevent duplicate logins within 30 seconds
        $recentLogin = ActivityLog::where('user_id', $user->id)
            ->where('action', 'User Login')
            ->where('created_at', '>', now()->subSeconds(30))
            ->exists();
        
        if ($recentLogin) {
            return;
        }

        $roleName = match ((int) $user->role_id) {
            1       => 'Job Seeker',
            2       => 'Employer',
            3       => 'Admin',
            default => 'User',
        };

        $companyInfo = '';
        if ($user->isEmployer() && $user->employerProfile) {
            $companyInfo = " ({$user->employerProfile->company_name})";
        }

        ActivityLog::create([
            'user_id'     => $user->id,
            'action'      => 'User Login',
            'description' => "{$roleName}{$companyInfo} logged in: {$user->name} ({$user->email})",
            'ip_address'  => $this->request->ip(),
            'user_agent'  => $this->request->userAgent(),
        ]);
    }
}