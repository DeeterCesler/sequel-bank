#!/usr/bin/env bash
set -e

# Make storage writable
mkdir -p /var/www/html/storage/logs
chmod -R 775 /var/www/html/storage
chown -R www-data:www-data /var/www/html/storage

# Create minimal .env file if it doesn't exist
if [ ! -f /var/www/html/.env ]; then
  echo "APP_KEY=" > /var/www/html/.env
fi

# Generate app key if not set
php /var/www/html/artisan key:generate --force

# Run migrations (sqlite might not need connection check)
php /var/www/html/artisan migrate --force

# Run seeds
php /var/www/html/artisan db:seed --force

# Start PHP-FPM
php-fpm -D

# Start Nginx (no daemon off flag since it's in your config)
exec nginx
