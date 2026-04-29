<?php
require_once __DIR__ . '/app/Services/ZegoToken.php';

try {
    $token = App\Services\ZegoToken::generate(
        948409277,
        'ce03ae3dcd79230ca20ec00a5faa7ec2',
        'test_room',
        '123',
        'Test User'
    );
    
    echo "✅ SUCCESS! Token generated:\n\n";
    echo $token . "\n\n";
    echo "Token length: " . strlen($token) . " characters\n";
    
} catch (Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
}
