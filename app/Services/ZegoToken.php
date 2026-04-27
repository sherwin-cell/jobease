<?php

namespace App\Services;

class ZegoToken
{
    public static function generate($appID, $serverSecret, $roomID, $userID, $userName, $expire = 7200)
    {
        $now = time();
        $nonce = bin2hex(random_bytes(16));
        
        // Build the payload that needs to be signed
        $payload = [
            'app_id' => (int) $appID,
            'user_id' => (string) $userID,
            'room_id' => (string) $roomID,
            'nonce' => $nonce,
            'ctime' => $now,
            'expire' => $now + $expire,
        ];

        // Create signature using HMAC-SHA256
        $payloadJson = json_encode($payload);
        $signature = hash_hmac('sha256', $payloadJson, $serverSecret, true);
        
        // Build final token with all required fields
        $tokenPayload = [
            'app_id' => (int) $appID,
            'room_id' => (string) $roomID,
            'user_id' => (string) $userID,
            'user_name' => (string) $userName,
            'nonce' => $nonce,
            'ctime' => $now,
            'expire' => $now + $expire,
            'signature' => $signature,
        ];

        // Return base64 encoded token
        return self::base64UrlEncode(json_encode($tokenPayload));
    }

    private static function base64UrlEncode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}