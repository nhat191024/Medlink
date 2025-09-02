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

# Run migrations
# php artisan migrate --force

# Seed initial data if needed (optional)
# php artisan db:seed --force

#npm
npm install
npm run build

# Khởi động lại queue nếu cần
php artisan queue:restart

# Start supervisor to manage all services (Apache, Queue, Scheduler)
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/laravel.conf
