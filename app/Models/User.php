<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Employer;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id', // <-- add this
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // -----------------------------
    // Role relationship
    // -----------------------------
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'employer_id');
    }


    // -----------------------------
    // Helper methods
    // -----------------------------
    private function roleName(): ?string
    {
        if ($this->relationLoaded('role')) {
            return $this->role?->name;
        }

        // Fallback to querying role name using role_id.
        return $this->role?->name ?? $this->role()->value('name');
    }

    public function isAdmin(): bool
    {
        return $this->roleName() === 'admin';
    }

    public function isEmployer(): bool
    {
        return $this->roleName() === 'employer';
    }
    public function employer()
    {
        return $this->hasOne(Employer::class);
    }

    public function isJobSeeker(): bool
    {
        return $this->roleName() === 'job_seeker';
    }

    public function dashboardRoute()
    {
        return match ($this->roleName() ?? '') {
            'job_seeker' => 'jobseeker.dashboard',
            'employer' => 'employer.dashboard',
            'admin' => 'admin.dashboard',
            default => '/',
        };
    }

}