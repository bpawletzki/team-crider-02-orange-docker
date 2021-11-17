FROM php:8-fpm-alpine

RUN apk add zlib-dev libmemcached-dev php8-pecl-xdebug  \
    && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
    && docker-php-ext-configure mysqli --with-mysqli=mysqlnd \
    && docker-php-ext-install mysqli pdo pdo_mysql
