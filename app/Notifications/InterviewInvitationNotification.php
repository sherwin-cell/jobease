<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class InterviewInvitationNotification extends Notification
{
    use Queueable;

    protected $application;

    /**
     * Create a new notification instance.
     */
    public function __construct($application)
    {
        $this->application = $application;
    }

    /**
     * Determine which channels the notification will be delivered on.
     */
    public function via($notifiable)
    {
        return ['database']; // stored in notifications table
    }

    /**
     * Store notification in database
     */
    public function toDatabase($notifiable)
    {
        return [
            'message' => 'You have been invited to an interview for the position: ' 
                        . $this->application->job->title,
            'job_id' => $this->application->job->id,
            'application_id' => $this->application->id,
            'status' => 'Interview',
        ];
    }
}