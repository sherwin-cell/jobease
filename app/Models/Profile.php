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
        'interests',
    ];

    protected $casts = [
        'skills' => 'array',
        'interests' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }
    public function education()
    {
        return $this->hasMany(Education::class);
    }
    public function certifications()
    {
        return $this->hasMany(Certification::class);
    }

    public function isCompanyProfileComplete()
    {
        // Example logic: Check if required fields for company profile are filled
        return $this->headline && $this->bio && $this->location && $this->phone;
    }
}