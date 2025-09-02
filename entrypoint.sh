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

# Start queue worker with multiple workers for better performance
php artisan queue:work database --daemon --sleep=1 --tries=3 --max-time=3600 --memory=512 --timeout=90 &
QUEUE_PID1=$!

# Start second queue worker for redundancy
php artisan queue:work database --daemon --sleep=1 --tries=3 --max-time=3600 --memory=512 --timeout=90 &
QUEUE_PID2=$!

# Start scheduler
php artisan schedule:work --sleep=60 &
SCHEDULER_PID=$!

# Function to handle shutdown
cleanup() {
    echo "Shutting down services..."
    kill $QUEUE_PID1 $QUEUE_PID2 $SCHEDULER_PID 2>/dev/null
    wait
    exit 0
}

# Trap signals
trap cleanup SIGTERM SIGINT

# Monitor processes and restart if they die
while true; do
    # Check if queue workers are still running
    if ! kill -0 $QUEUE_PID1 2>/dev/null; then
        echo "Queue worker 1 died, restarting..."
        php artisan queue:work database --daemon --sleep=1 --tries=3 --max-time=3600 --memory=512 --timeout=90 &
        QUEUE_PID1=$!
    fi

    if ! kill -0 $QUEUE_PID2 2>/dev/null; then
        echo "Queue worker 2 died, restarting..."
        php artisan queue:work database --daemon --sleep=1 --tries=3 --max-time=3600 --memory=512 --timeout=90 &
        QUEUE_PID2=$!
    fi

    if ! kill -0 $SCHEDULER_PID 2>/dev/null; then
        echo "Scheduler died, restarting..."
        php artisan schedule:work --sleep=60 &
        SCHEDULER_PID=$!
    fi

    sleep 30
done
# EOF

# Make script executable
# chmod +x /tmp/start-services.sh

# Start services if no command provided
# if [ "$#" -eq 0 ]; then
#     exec /tmp/start-services.sh
# else
#     exec "$@"
# fi
