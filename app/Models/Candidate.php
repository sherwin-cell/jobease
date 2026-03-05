<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = ['name', 'experience', 'location', 'status'];

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }
}
