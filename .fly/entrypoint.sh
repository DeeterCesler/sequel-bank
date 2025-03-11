#!/bin/bash

cd /var/www/html
php artisan migrate --force

# Start the PHP server on the correct port and interface
php artisan serve --host=0.0.0.0 --port=8080
