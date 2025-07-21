<?php

// Create User Script
require_once __DIR__ . '/vendor/autoload.php';

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    // Create or update the test user
    $user = User::updateOrCreate(
        ['email' => 'test@example.com'],
        [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]
    );

    echo "✅ User created successfully!\n";
    echo "Email: test@example.com\n";
    echo "Password: password\n";
    echo "User ID: " . $user->id . "\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
