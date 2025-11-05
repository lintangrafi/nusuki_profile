#!/bin/bash
set -e

# Ensure we're in the right directory
cd /var/task

# Install PHP dependencies
echo "Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader

# Generate application key
php artisan key:generate --force

# Run database migrations if needed
# php artisan migrate --force

# Build frontend assets
echo "Building frontend assets..."
npm install
npm run build

# Create storage directory for runtime
mkdir -p /tmp/storage
mkdir -p /tmp/cache

# Create database in tmp directory if using SQLite
touch /tmp/database.sqlite

echo "Build completed successfully!"