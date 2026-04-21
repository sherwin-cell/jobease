<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillTag extends Model
{
    protected $fillable = [
        'name',
    ];

    // Many-to-many with questions
    public function questions()
    {
        return $this->belongsToMany(SkillQuestion::class);
    }
}