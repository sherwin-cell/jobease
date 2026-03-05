<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
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
        'interests'
    ];

    // Cast JSON columns to arrays automatically
    protected $casts = [
        'skills' => 'array',
        'experience' => 'array',
        'education' => 'array',
        'certifications' => 'array',
        'interests' => 'array',
    ];

    // Define relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}