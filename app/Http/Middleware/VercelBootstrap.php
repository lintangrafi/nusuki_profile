<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VercelBootstrap
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Create necessary directories in /tmp for Vercel's read-only file system
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

        // Set custom paths for Laravel's storage and bootstrap directories
        if (!defined('STDIN')) {
            $_ENV['APP_STORAGE'] = '/tmp/storage';
            $_ENV['COMPILED_CACHE_PATH'] = '/tmp/bootstrap/cache';
            putenv('APP_STORAGE=/tmp/storage');
            putenv('COMPILED_CACHE_PATH=/tmp/bootstrap/cache');
        }

        return $next($request);
    }
}