#!/bin/bash

cd /var/www/html
php artisan migrate --force

# Create directory for PHP-FPM socket if it doesn't exist
mkdir -p /var/run/php

# Start PHP-FPM
service php8.2-fpm start

# Wait for PHP-FPM to create the socket
while [ ! -S /var/run/php/php-fpm.sock ]; do
    echo "Waiting for PHP-FPM socket..."
    sleep 1
done

# Ensure correct permissions
chmod 660 /var/run/php/php-fpm.sock
chown www-data:www-data /var/run/php/php-fpm.sock

# Start Nginx
nginx
