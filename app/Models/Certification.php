<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $fillable = ['profile_id', 'name', 'issuing_org', 'issue_date', 'expiration_date'];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}