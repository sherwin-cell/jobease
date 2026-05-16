<?php

namespace App\Services;

class ZegoToken
{
    public static function generate($appID, $serverSecret, $roomID, $userID, $userName)
    {
        $appID      = (int) $appID;
        $expire     = time() + 3600;
        $nonce      = mt_rand(100000, 999999);

        // Build the token info
        $tokenInfo = [
            'app_id'   => $appID,
            'user_id'  => (string) $userID,
            'nonce'    => $nonce,
            'ctime'    => time(),
            'expire'   => $expire,
            'payload'  => '',
        ];

        $tokenInfoJson = json_encode($tokenInfo);

        // Encrypt with AES-128-CBC
        $iv        = openssl_random_pseudo_bytes(16);
        $encrypted = openssl_encrypt(
            $tokenInfoJson,
            'AES-128-CBC',
            $serverSecret,
            OPENSSL_RAW_DATA,
            $iv
        );

        // Pack expire + iv + encrypted
        $rawToken = pack('N', $expire) . $iv . $encrypted;

        // Base64 encode
        $token = '04' . base64_encode($rawToken);

        return $token;
    }
}