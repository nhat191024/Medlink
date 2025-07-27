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

# Run migrations
# php artisan migrate --force

# Seed initial data if needed (optional)
# php artisan db:seed --force

# Start services using supervisor or run in background
# Create a simple process manager script
cat > /tmp/start-services.sh << 'EOF'
#!/bin/bash

# Start queue worker in background
php artisan queue:work --daemon --sleep=3 --tries=3 --timeout=60 &
QUEUE_PID=$!

# Start scheduler in background
php artisan schedule:work --sleep=60 &
SCHEDULER_PID=$!

# Function to handle shutdown
cleanup() {
    echo "Shutting down services..."
    kill $QUEUE_PID $SCHEDULER_PID 2>/dev/null
    wait
    exit 0
}

# Trap signals
trap cleanup SIGTERM SIGINT

# Wait for processes
wait
EOF

# Make script executable
chmod +x /tmp/start-services.sh

# Start services if no command provided
if [ "$#" -eq 0 ]; then
    exec /tmp/start-services.sh
else
    exec "$@"
fi
