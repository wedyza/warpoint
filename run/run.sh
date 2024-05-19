# Installing dependencies
php -f composer.phar install

# Migrate db
php artisan migrate --seed

# Run App
php artisan serve --host=0.0.0.0