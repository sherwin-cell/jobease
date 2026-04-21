<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillAnswer extends Model
{
    protected $fillable = [
        'user_id',
        'skill_question_id',
        'answer',
    ];

    // 👤 Who answered
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ❓ Which question
    public function question()
    {
        return $this->belongsTo(SkillQuestion::class, 'skill_question_id');
    }
}