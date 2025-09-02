#!/bin/bash

# Tạo thư mục cần thiết
mkdir -p /var/www/html/storage/framework/{sessions,views,cache}
mkdir -p /var/log/supervisor

# Set permissions
chmod -R 775 /var/www/html
chown -R www-data:www-data /var/www/html

chmod -R 775 /var/www/html/storage
chown -R www-data:www-data /var/www/html/storage

chmod -R 775 /var/www/html/storage/logs
chown -R www-data:www-data /var/www/html/storage/logs

chmod -R 775 /var/www/html/vendor
chown -R www-data:www-data /var/www/html/vendor

# Cài đặt dependencies
echo "Installing PHP dependencies..."
composer install --optimize-autoloader --no-dev

# Storage link
php artisan storage:link

# Clear và optimize cache
php artisan optimize:clear

# Generate application key nếu chưa có
php artisan key:generate --no-interaction

# Chờ database sẵn sàng
echo "Waiting for database connection..."
until php artisan migrate:status > /dev/null 2>&1; do
    echo "Database not ready, waiting..."
    sleep 2
done

echo "Database is ready!"

# Run migrations
echo "Running migrations..."
php artisan migrate

# Install và build npm assets
echo "Installing and building frontend assets..."
npm install
npm run build

# Clear queue để khởi động lại
echo "Restarting queue..."
php artisan queue:restart

# Chạy với supervisor nếu không có argument
if [ "$#" -eq 0 ]; then
    echo "Starting services with supervisor..."
    exec /usr/bin/supervisord -c /etc/supervisor/supervisord.conf
else
    echo "Running custom command: $@"
    exec "$@"
fi
