<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'skill_id',
        'title',
        'body',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }

    public function answers()
    {
        return $this->hasMany(SkillAnswer::class, 'question_id');
    }

    public function tags()
    {
        return $this->belongsToMany(SkillTag::class, 'skill_question_tag');
    }
}
