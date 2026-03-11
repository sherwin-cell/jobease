<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    protected $fillable = [
        'user_id',       // ← ADD THIS
        'company_name',
        'location',
        'website'
    ];

    // Employer belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class); // ← ADD THIS
    }

    // Employer has many Jobs
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}