#!/usr/bin/env bash
# Exit on error
set -o errexit

echo "Running composer..."
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

echo "Caching config and routes..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Running migrations..."
php artisan migrate --force
