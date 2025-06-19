#!/bin/bash

mkdir -p /var/www/html/storage/framework/{sessions,views,cache}

chmod -R 775 /var/www/html
chown -R www-data:www-data /var/www/html

chmod -R 775 /var/www/html/storage
chown -R www-data:www-data /var/www/html/storage

chmod -R 775 /var/www/html/vendor
chown -R www-data:www-data /var/www/html/vendor

# npm install
# npm run build

php artisan optimize:clear

exec "$@"
