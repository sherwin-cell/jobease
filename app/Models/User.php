<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Role;
use App\Models\Application;
use App\Models\Job;
use App\Models\JobseekerProfile;
use App\Models\EmployerProfile;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // -----------------------------
    // ROLE RELATIONSHIP
    // -----------------------------
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // -----------------------------
    // PROFILES (NEW SYSTEM)
    // -----------------------------

    // 👤 Jobseeker Profile
    public function jobseekerProfile()
    {
        return $this->hasOne(JobseekerProfile::class);
    }

    // 🏢 Employer Profile
    public function employerProfile()
    {
        return $this->hasOne(EmployerProfile::class);
    }

    // -----------------------------
    // APPLICATIONS / JOBS
    // -----------------------------
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'employer_id');
    }

    // -----------------------------
    // ROLE HELPERS
    // -----------------------------
    public function isAdmin(): bool
    {
        return (int) $this->role_id === 3;
    }

    public function isEmployer(): bool
    {
        return (int) $this->role_id === 2;
    }

    public function isJobSeeker(): bool
    {
        return (int) $this->role_id === 1;
    }

    // -----------------------------
    // DASHBOARD ROUTING
    // -----------------------------
    public function dashboardRoute()
    {
        return match ((int) $this->role_id) {
            1 => 'jobseeker.dashboard',
            2 => 'employer.dashboard',
            3 => 'admin.dashboard',
            default => '/',
        };
    }
}