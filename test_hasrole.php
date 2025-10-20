<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;

try {
    $user = new User();
    echo "User model created successfully\n";
    
    if (method_exists($user, 'hasRole')) {
        echo "hasRole method exists!\n";
    } else {
        echo "hasRole method NOT found!\n";
    }
    
    // List all available methods
    $methods = get_class_methods($user);
    $hasRoleMethods = array_filter($methods, function($method) {
        return strpos($method, 'Role') !== false;
    });
    
    echo "Role-related methods: " . implode(', ', $hasRoleMethods) . "\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
