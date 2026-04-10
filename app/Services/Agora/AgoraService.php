<?php

namespace App\Services\Agora;

use Cyberdeep\LaravelAgoraTokenGenerator\Facades\AgoraToken;

class AgoraService
{
    /**
     * Generate an Agora RTC token for a given channel and user.
     *
     * @param string $channelName
     * @param int $uid
     * @param int $expireSeconds
     * @return string
     */
    public static function generateToken($channelName, $uid = 0, $expireSeconds = 3600)
    {
        // role: 1 = publisher (broadcaster)
        return AgoraToken::make(
            $channelName,
            $uid,
            $expireSeconds,
            1 // publisher
        );
    }
}
