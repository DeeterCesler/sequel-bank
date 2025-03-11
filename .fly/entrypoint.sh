#!/bin/bash

cd /var/www/html
php artisan migrate --force

# Start PHP-FPM
service php8.2-fpm start

# Start Nginx
nginx
