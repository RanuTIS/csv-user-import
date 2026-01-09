FROM php:8.2
WORKDIR /D/test-laravel
COPY --from=composer:latest /user/bin/composer
CMD php artisan serve --host=0.0.0.0 --post=8000