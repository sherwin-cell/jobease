<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = ['profile_id', 'degree', 'school', 'start_date', 'end_date'];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}