<?php
require 'vendor/autoload.php';

$configFiles = glob('config/*.php');

foreach ($configFiles as $file) {
    $filename = basename($file);
    echo "\n========== Testing: $filename ==========\n";
    
    try {
        $config = require $file;
        echo "✓ OK - No errors\n";
    } catch (Throwable $e) {
        echo "✗ ERROR in $filename\n";
        echo "Message: " . $e->getMessage() . "\n";
        echo "Line: " . $e->getLine() . "\n";
        echo "File: " . $e->getFile() . "\n";
    }
}

echo "\n\nDone!\n";