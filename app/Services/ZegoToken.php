<?php

namespace App\Services;

class ZegoToken
{
    public static function generate($appID, $serverSecret, $roomID, $userID, $userName)
    {
        $payload = json_encode([
            'room_id' => $roomID,
            'privilege' => [
                '1' => 1,
                '2' => 1,
            ]
        ]);
        
        $payloadBase64 = base64_encode($payload);
        $nonce = mt_rand(100000, 999999);
        $expire = time() + 3600;
        
        $tokenData = json_encode([
            'app_id' => (int)$appID,
            'user_id' => (string)$userID,
            'nonce' => $nonce,
            'expire' => $expire,
            'payload' => $payloadBase64,
            'version' => '04'
        ]);
        
        $signature = hash_hmac('sha256', $tokenData, $serverSecret, true);
        $token = base64_encode($tokenData) . '.' . base64_encode($signature);
        
        return $token;
    }
}