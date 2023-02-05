FROM php:8.2-fpm

WORKDIR /var/www/app

RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

EXPOSE 9000

RUN composer install
