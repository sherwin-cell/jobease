<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
