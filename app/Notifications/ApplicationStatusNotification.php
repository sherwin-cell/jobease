<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class ApplicationStatusNotification extends Notification
{
    protected $application;

    public function __construct($application)
    {
        $this->application = $application;
    }

    public function via($notifiable)
    {
        return ['database']; // store in DB
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Your application for "' .
                $this->application->job->title .
                '" has been updated to: ' .
                $this->application->status,
            'application_id' => $this->application->id,
        ];
    }
}