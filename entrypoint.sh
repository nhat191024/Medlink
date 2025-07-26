#!/bin/bash

mkdir -p /var/www/html/storage/framework/{sessions,views,cache}

chmod -R 775 /var/www/html
chown -R www-data:www-data /var/www/html

chmod -R 775 /var/www/html/storage
chown -R www-data:www-data /var/www/html/storage

chmod -R 775 /var/www/html/storage/logs
chown -R www-data:www-data /var/www/html/storage/logs

chmod -R 775 /var/www/html/vendor
chown -R www-data:www-data /var/www/html/vendor

# npm install
# npm run build

# run composer install
# Cài đặt các dependency của Laravel
# Cho Production
# RUN composer install --no-dev --optimize-autoloader
# Cho Development
composer install --optimize-autoloader

# storage link
php artisan storage:link
# optimize the application
php artisan optimize:clear
# generate application key
php artisan key:generate
#start the queue worker
php artisan queue:work --daemon --sleep=3 --tries=3 --timeout=60

exec "$@"
