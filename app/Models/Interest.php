<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    protected $fillable = ['profile_id', 'name'];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}