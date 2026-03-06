<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'user_id',
        'headline',
        'bio',
        'location',
        'phone',
        'website',
        'skills',
        'experience',
        'education',
        'certifications',
        'interests',
    ];

    /**
     * Automatically cast JSON columns to arrays
     */
    protected $casts = [
        'skills' => 'array',
        'experience' => 'array',
        'education' => 'array',
        'certifications' => 'array',
        'interests' => 'array',
    ];

    /**
     * Relationship: Profile belongs to a User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Helper methods to safely access array fields
     */

    public function getSkillsList(): array
    {
        return $this->skills ?? [];
    }

    public function getExperienceList(): array
    {
        return $this->experience ?? [];
    }

    public function getEducationList(): array
    {
        return $this->education ?? [];
    }

    public function getCertificationsList(): array
    {
        return $this->certifications ?? [];
    }

    public function getInterestsList(): array
    {
        return $this->interests ?? [];
    }
    
        /**
         * Relationship: Profile belongs to many Skills
         */
        public function skills()
        {
            return $this->belongsToMany(Skill::class);
        }
}