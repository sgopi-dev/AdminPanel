#!/bin/bash
set -e

echo "Starting Entrypoint Script..."

# Ensure the database directory exists
mkdir -p /var/www/database

# Create the SQLite file if it doesn't exist
if [ ! -f /var/www/database/database.sqlite ]; then
    echo "Creating database.sqlite..."
    touch /var/www/database/database.sqlite
fi

# Run migrations (and seed if needed)
# Note: --force is required to run migrations in production environments without a prompt
echo "Running Database Migrations..."
php artisan migrate:fresh --seed --force
php artisan storage:link



# You can optionally uncomment the next line if you want to seed on every startup, 
# though usually, you only want to seed once.
# php artisan db:seed --force

# Clear and cache configurations for optimal performance
echo "Caching Configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Entrypoint tasks completed. Starting main process."

# Hand off to the CMD defined in the Dockerfile
exec "$@"