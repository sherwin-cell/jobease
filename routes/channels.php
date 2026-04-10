<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::routes(['middleware' => ['web', 'auth']]);

Broadcast::channel('skill-question.{skillQuestionId}', function ($user, $skillQuestionId) {
    return $user !== null;
});

