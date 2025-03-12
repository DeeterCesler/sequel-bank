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

FOLDER=/var/www/html/storage/database
if [ ! -d "$FOLDER" ]; then
    echo "$FOLDER is not a directory, initializing database" 
    mkdir /var/www/html/storage/database
    touch /var/www/html/storage/database/database.sqlite
    chown www-data:www-data /var/www/html/storage/database/database.sqlite
fi

# Generate app key if not set
php /var/www/html/artisan key:generate --force

# Run migrations
php /var/www/html/artisan migrate --force

# Run seeds
php /var/www/html/artisan db:seed --force

# Start PHP-FPM
php-fpm -D

# Start Nginx (no daemon off flag since it's in your config)
exec nginx
