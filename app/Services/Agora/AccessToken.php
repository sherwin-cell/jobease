<?php

namespace App\Services\Agora;

/**
 * Minimal Agora RTC token generator (PHP), adapted from AgoraIO Tools.
 * Generates AccessToken (006) compatible RTC tokens.
 */
class AccessToken
{
    public const VERSION = '006';

    /** @var array<string,int> */
    public const PRIVILEGES = [
        'kJoinChannel' => 1,
        'kPublishAudioStream' => 2,
        'kPublishVideoStream' => 3,
        'kPublishDataStream' => 4,
    ];

    private string $appId;
    private string $appCertificate;
    private string $channelName;
    private string $uid;

    /** @var array<int,int> */
    private array $message = [];

    public static function init(string $appId, string $appCertificate, string $channelName, string $uid): self
    {
        $obj = new self();
        $obj->appId = $appId;
        $obj->appCertificate = $appCertificate;
        $obj->channelName = $channelName;
        $obj->uid = (string) $uid;
        return $obj;
    }

    public function addPrivilege(int $privilege, int $expireTimestamp): void
    {
        $this->message[$privilege] = $expireTimestamp;
    }

    public function build(): string
    {
        $random = random_int(1, 99999999);
        $ts = time() + 24 * 3600;

        $signature = $this->sign($random, $ts);
        $content = $this->packContent($signature, $random, $ts, $this->message);

        return self::VERSION . $this->appId . base64_encode($content);
    }

    private function sign(int $random, int $ts): string
    {
        $raw = $this->appId . $this->channelName . $this->uid . $ts . $random;
        return hash_hmac('sha256', $raw, $this->appCertificate, true);
    }

    /**
     * Pack binary content as Agora expects (little-endian).
     *
     * @param string $signature binary
     * @param array<int,int> $message
     */
    private function packContent(string $signature, int $random, int $ts, array $message): string
    {
        $buf = '';
        $buf .= $this->packString($signature);
        $buf .= pack('V', $ts);
        $buf .= pack('V', $random);
        $buf .= pack('V', count($message));
        foreach ($message as $k => $v) {
            $buf .= pack('V', (int) $k);
            $buf .= pack('V', (int) $v);
        }
        return $buf;
    }

    private function packString(string $str): string
    {
        return pack('V', strlen($str)) . $str;
    }
}

