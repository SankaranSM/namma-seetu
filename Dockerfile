FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip zip libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . /var/www

RUN composer install --no-dev --optimize-autoloader

EXPOSE 10000

CMD php artisan migrate --force \
 && php artisan db:seed --force \
 && php -S 0.0.0.0:10000 -t public
