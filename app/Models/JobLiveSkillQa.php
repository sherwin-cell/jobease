<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobLiveSkillQa extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'enabled',
        'duration_minutes',
        'max_candidates',
        'session_type',
        'screen_sharing_allowed',
        'slots',
        'question_categories',
        'questions',
    ];

    protected $casts = [
        'enabled' => 'boolean',
        'screen_sharing_allowed' => 'boolean',
        'slots' => 'array',
        'question_categories' => 'array',
        'questions' => 'array',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}

