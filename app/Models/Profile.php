<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','headline','bio','location','phone','website'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'profile_skill');
    }

    public function certifications()
    {
        return $this->hasMany(Certification::class);
    }

    public function interests()
    {
        return $this->hasMany(Interest::class);
    }
}