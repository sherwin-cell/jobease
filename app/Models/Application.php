<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'user_id',
        'job_id',
        'cover_letter',
        'applied_at',
        'resume',
        'status',
    ];

    protected $casts = [
        'applied_at' => 'datetime',
        'status' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}