FROM php:8.2-fpm-alpine

RUN apk --no-cache add \
        bash \
        icu-dev \
        libzip-dev \
        oniguruma-dev \
    && docker-php-ext-install pdo_mysql

COPY --from=composer:2.8 /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www
CMD ["php-fpm"]
