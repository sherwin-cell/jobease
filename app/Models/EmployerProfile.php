<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'description',
        'location',
        'phone',
        'website',
        'business_permit',
        'approval_status',
        'rejection_reason',
        'approved_at',
        'approved_by',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    /**
     * Relationship: EmployerProfile belongs to User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if employer profile is complete
     */
    public function getIsCompleteAttribute()
    {
        return $this->company_name
            && $this->description
            && $this->location
            && $this->phone;
    }

    /**
     * Check if employer profile is fully complete (including business permit)
     */
    public function isFullyComplete()
    {
        return $this->is_complete && $this->business_permit;
    }

    /**
     * Check if employer profile is approved
     */
    public function isApproved()
    {
        return $this->approval_status === 'approved';
    }

    /**
     * Check if employer profile is pending
     */
    public function isPending()
    {
        return $this->approval_status === 'pending';
    }

    /**
     * Check if employer profile is rejected
     */
    public function isRejected()
    {
        return $this->approval_status === 'rejected';
    }

    /**
     * Get the user who approved the profile
     */
    public function approvedByUser()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}