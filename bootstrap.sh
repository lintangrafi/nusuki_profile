#!/bin/bash

# Create necessary directories in /tmp since Vercel's file system is read-only
mkdir -p /tmp/storage/logs
mkdir -p /tmp/storage/framework/cache
mkdir -p /tmp/storage/framework/sessions
mkdir -p /tmp/storage/framework/views
mkdir -p /tmp/bootstrap/cache

# Set environment variables for Laravel
export APP_STORAGE=/tmp/storage
export COMPILED_CACHE_PATH=/tmp/bootstrap/cache

# Link storage to tmp directory (if using file storage)
# ln -sfn /tmp/storage ./storage

# If you need to create a SQLite database at runtime
if [ ! -f /tmp/database.sqlite ]; then
    echo "Creating SQLite database..."
    touch /tmp/database.sqlite
fi

# Copy the application to a writable location if needed
cp -r ./storage/* /tmp/storage/ 2>/dev/null || true

echo "Bootstrap completed!"