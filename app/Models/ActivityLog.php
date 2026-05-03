<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityLog extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'action',
        'description',
        'ip_address',
        'user_agent',
    ];
    
    protected $casts = [
        'created_at' => 'datetime',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Helper method to log activities
    public static function log($userId, $action, $description, $request = null)
    {
        $log = new static();
        $log->user_id = $userId;
        $log->action = $action;
        $log->description = $description;
        
        if ($request) {
            $log->ip_address = $request->ip();
            $log->user_agent = $request->userAgent();
        }
        
        $log->save();
        
        return $log;
    }
}