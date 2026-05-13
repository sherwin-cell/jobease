<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Auth\Notifications\VerifyEmail;

class QueuedVerifyEmail extends VerifyEmail
{
    use Queueable;
}