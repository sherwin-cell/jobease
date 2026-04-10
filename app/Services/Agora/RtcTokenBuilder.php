<?php

namespace App\Services\Agora;

class RtcTokenBuilder
{
    public const ROLE_ATTENDEE = 0;
    public const ROLE_PUBLISHER = 1;
    public const ROLE_SUBSCRIBER = 2;

    public static function buildTokenWithUid(
        string $appId,
        string $appCertificate,
        string $channelName,
        int $uid,
        int $role,
        int $privilegeExpireTs
    ): string {
        return self::buildTokenWithUserAccount(
            $appId,
            $appCertificate,
            $channelName,
            (string) $uid,
            $role,
            $privilegeExpireTs
        );
    }

    public static function buildTokenWithUserAccount(
        string $appId,
        string $appCertificate,
        string $channelName,
        string $userAccount,
        int $role,
        int $privilegeExpireTs
    ): string {
        $token = AccessToken::init($appId, $appCertificate, $channelName, $userAccount);
        $token->addPrivilege(AccessToken::PRIVILEGES['kJoinChannel'], $privilegeExpireTs);
        if (in_array($role, [self::ROLE_PUBLISHER, self::ROLE_SUBSCRIBER], true)) {
            $token->addPrivilege(AccessToken::PRIVILEGES['kPublishAudioStream'], $privilegeExpireTs);
            $token->addPrivilege(AccessToken::PRIVILEGES['kPublishVideoStream'], $privilegeExpireTs);
            $token->addPrivilege(AccessToken::PRIVILEGES['kPublishDataStream'], $privilegeExpireTs);
        }
        return $token->build();
    }
}

