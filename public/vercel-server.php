<?php
/**
 * Custom entry point for Vercel
 * This file acts as a bridge between Vercel's PHP runtime and Laravel
 */

// Set working directory to project root
chdir(__DIR__.'/..');

// Set custom storage path for Vercel's read-only file system
putenv('APP_STORAGE=/tmp/storage');

// Create required directories in /tmp
$requiredDirs = [
    '/tmp/storage',
    '/tmp/storage/logs',
    '/tmp/storage/framework',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/bootstrap',
    '/tmp/bootstrap/cache'
];

foreach ($requiredDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Load the main Laravel application
require_once __DIR__.'/index.php';