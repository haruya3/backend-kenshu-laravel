FROM php:8.2-fpm

ENV TZ Asia/Tokyo

RUN apt-get update && \
	apt-get install -y git unzip libzip-dev libicu-dev libonig-dev libjpeg62-turbo-dev libpng-dev&& \
    pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    docker-php-ext-configure gd --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd &&\
	docker-php-ext-install intl pdo_mysql zip bcmath

COPY ./php.development.ini /usr/local/etc/php/php.ini

COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

WORKDIR /laravel