<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobseekerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'skills',
        'experience',
        'education',
        'certifications',
        'interests',
    ];

    protected $casts = [
        'skills' => 'array',
        'experience' => 'array',
        'education' => 'array',
        'certifications' => 'array',
        'interests' => 'array',
    ];

    /**
     * Relationship: JobseekerProfile belongs to User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if jobseeker profile is complete
     */
    public function isComplete()
    {
        return $this->skills && $this->experience && $this->education;
    }
}