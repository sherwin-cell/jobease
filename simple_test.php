<?php
require_once 'app/Services/ZegoToken.php';

$token = App\Services\ZegoToken::generate(
    948409277,
    'ce03ae3dcd79230ca20ec00a5faa7ec2',
    'test_room',
    '123',
    'Test User'
);

echo "Token: " . $token . "\n";
echo "Length: " . strlen($token) . "\n";
