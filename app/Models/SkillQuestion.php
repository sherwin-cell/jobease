<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Skill;
use App\Models\SkillTag;
use App\Models\SkillAnswer;
use App\Models\Job;

class SkillQuestion extends Model
{
    protected $fillable = [
        'user_id',
        'skill_id',
        'job_id',
        'title',
        'description',
    ];

    // 👤 Question owner
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🧠 Related skill
    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }

    // 💼 Related job
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    // 🏷️ Tags
    public function tags()
    {
        return $this->belongsToMany(SkillTag::class);
    }

    // 💬 Answers
    public function answers()
    {
        return $this->hasMany(SkillAnswer::class);
    }
}