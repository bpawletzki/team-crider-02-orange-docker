FROM php:8-fpm-alpine
RUN apk add --no-cache $PHPIZE_DEPS \
    && apk add zlib-dev libmemcached-dev \
    && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
    && docker-php-ext-configure mysqli --with-mysqli=mysqlnd \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && pecl install xdebug \
    && pecl install memcached \
    && docker-php-ext-enable memcached xdebug
