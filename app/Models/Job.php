<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SkillQuestion;
use App\Models\Application;
use App\Models\JobLiveSkillQa;
use App\Models\User;

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
        'skills_required',
    ];

    protected $casts = [
        'skills_required' => 'array',
    ];

    // Skill Questions for this job
    public function skillQuestions()
    {
        return $this->hasMany(SkillQuestion::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function liveSkillQa()
    {
        return $this->hasOne(JobLiveSkillQa::class, 'job_id');
    }
}