<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'user_id',
        'employer_id',
        'question',
        'is_anonymous'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}