#!/usr/bin/env bash
set -e

# Make storage writable
mkdir -p /var/www/html/storage/logs
chmod -R 775 /var/www/html/storage
chown -R www-data:www-data /var/www/html/storage

# Generate app key if not set
php /var/www/html/artisan key:generate --force

# Run migrations (sqlite might not need connection check)
php /var/www/html/artisan migrate --force

# Start PHP-FPM
php-fpm -D

# Start Nginx (no daemon off flag since it's in your config)
exec nginx
