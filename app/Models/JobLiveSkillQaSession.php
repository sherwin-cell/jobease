<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobLiveSkillQaSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'created_by',
        'slot_start_at',
        'slot_end_at',
        'status',
        'started_at',
        'ended_at',
    ];

    protected $casts = [
        'slot_start_at' => 'datetime',
        'slot_end_at' => 'datetime',
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function participants()
    {
        return $this->hasMany(JobLiveSkillQaSessionParticipant::class, 'session_id');
    }
}

