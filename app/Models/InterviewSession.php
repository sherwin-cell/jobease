<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterviewSession extends Model
{
    protected $fillable = [
        'job_id',
        'application_id',
        'employer_id',
        'job_seeker_id',
        'room_id',
        'scheduled_at',
        'status',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id');
    }

    public function jobSeeker()
    {
        return $this->belongsTo(User::class, 'job_seeker_id');
    }
}