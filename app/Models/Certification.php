<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'name',
        'authority',
        'date_obtained',
        'expiration_date',
        'description',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
