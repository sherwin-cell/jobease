<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Firebase\JWT\JWT;

class Controller
{
    use AuthorizesRequests;

    public function call(\App\Models\InterviewSession $session)
    {
        $appID = 948409277;
        $serverSecret = env('ZEGO_SERVER_SECRET');
        if (!$serverSecret) {
            abort(500, 'ZEGO_SERVER_SECRET is not set');
        }
        $userID = auth()->id();
        $userName = auth()->user()->name;
        $roomID = "room_" . $session->id;

        // Token valid for 2 hours
        $expire = time() + 2 * 60 * 60;

        $payload = [
            'app_id' => $appID,
            'user_id' => (string)$userID,
            'room_id' => $roomID,
            'exp' => $expire,
            'privilege' => [
                'loginRoom' => 1,
                'publishStream' => 1,
            ],
        ];

        $kitToken = JWT::encode($payload, $serverSecret, 'HS256');

        return view('interviews.call', compact('session', 'kitToken', 'appID', 'userID', 'userName', 'roomID'));
    }
}