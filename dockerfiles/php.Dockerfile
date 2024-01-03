FROM php:8.2-fpm-alpine

WORKDIR /var/www/laravel

RUN apk --no-cache update \
    && apk add --no-cache autoconf g++ make \
    postgresql-dev \
    \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    \
    && docker-php-ext-install pdo_pgsql \
RUN chown -R www-data:www-data /var/www