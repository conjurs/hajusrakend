<?php

// Check storage directory permissions
if (!is_writable(storage_path())) {
    echo "Storage directory is not writable\n";
    chmod(storage_path(), 0755);
}

// Check storage/logs directory
if (!is_dir(storage_path('logs'))) {
    mkdir(storage_path('logs'), 0755, true);
}

// Check storage/framework directories
$frameworkDirs = ['cache', 'sessions', 'views'];
foreach ($frameworkDirs as $dir) {
    $path = storage_path('framework/' . $dir);
    if (!is_dir($path)) {
        mkdir($path, 0755, true);
    }
}

// Create .env if it doesn't exist
if (!file_exists(base_path('.env'))) {
    copy(base_path('.env.example'), base_path('.env'));
    echo "Created .env file\n";
}

// Generate app key if not set
if (empty(env('APP_KEY'))) {
    Artisan::call('key:generate');
    echo "Generated new app key\n";
}

echo "Permissions check complete\n"; 