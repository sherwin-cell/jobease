<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

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

    protected $casts = [
        'skills'         => 'array',
        'experience'     => 'array',
        'education'      => 'array',
        'certifications' => 'array',
        'interests'      => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // DELETE all of these — no longer needed:
    // public function getSkillsList()
    // public function getExperienceList()
    // public function getEducationList()
    // public function getCertificationsList()
    // public function getInterestsList()
    // public function skills() ← ESPECIALLY THIS — conflicts with skills JSON field
}