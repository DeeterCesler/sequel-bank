#!/usr/bin/env bash
set -e

# Run migrations
php artisan migrate --force

# Start PHP-FPM and Nginx
php-fpm -D
nginx -g "daemon off;"
