<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'experience_level',
        'salary',
        'employer_id',
        'skills_required', // ← KEEP this
    ];

    protected $casts = [
        'skills_required' => 'array', // ← KEEP this
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    // DELETE skills() relationship
    // public function skills() ← REMOVE THIS

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id'); // ← correct
    }

    public function liveSkillQa()
    {
        return $this->hasOne(JobLiveSkillQa::class);
    }

}