<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InterviewScheduledMail extends Mailable
{
    use Queueable, SerializesModels;

    public $session;

    public function __construct($session)
    {
        $this->session = $session;
    }

    public function build()
    {
        return $this->subject('Interview Scheduled')
            ->view('emails.interview-scheduled')
            ->with([
                'session' => $this->session,
            ]);
    }
}