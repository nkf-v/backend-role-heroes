ARG PHP_EXTS="bcmath ctype fileinfo mbstring pdo pgsql pdo_pgsql dom pcntl"
ARG PHP_PECL_EXTS="xdebug"


FROM composer:2.2 as app-base

ARG PHP_EXTS

RUN mkdir -p /var/www /var/www/bin

WORKDIR /var/www

RUN apk update && apk add --no-cache libzip-dev zip libpq-dev postgresql-dev

RUN addgroup -S composer \
    && adduser -S composer -G composer \
    && chown -R composer /var/www

RUN apk add --virtual build-dependencies --no-cache ${PHPIZE_DEPS} openssl ca-certificates libpq-dev libxml2-dev oniguruma-dev && \
    docker-php-ext-install -j$(nproc) ${PHP_EXTS}

RUN apk del build-dependencies

USER composer

COPY --chown=composer composer.json composer.lock ./

RUN composer install --no-scripts --no-autoloader --prefer-dist

COPY --chown=composer . .

RUN composer install --prefer-dist


FROM php:8.0-fpm-alpine as app

ARG PHP_EXTS
ARG APP_ENV="production"

WORKDIR /var/www

RUN apk update && apk add  --no-cache libzip-dev zip libpq-dev postgresql-dev

RUN apk add --virtual build-dependencies --no-cache ${PHPIZE_DEPS} openssl ca-certificates libpq-dev libxml2-dev oniguruma-dev && \
    docker-php-ext-install -j$(nproc) ${PHP_EXTS}

RUN if [[ "$APP_ENV" = "local" ]] ; then pecl install xdebug ; fi
RUN if [[ "$APP_ENV" = "local" ]] ; then docker-php-ext-enable xdebug ; fi

RUN apk del build-dependencies

RUN if [[ "$APP_ENV" = "local" ]] ; then echo http://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories ; fi
RUN if [[ "$APP_ENV" = "local" ]] ; then apk add --no-cache shadow ; fi

COPY --from=app-base --chown=www-data /var/www /var/www

RUN if [[ "$APP_ENV" = "local" ]] ; then mv ./docker/app/confs/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini ; fi

RUN chmod +x ./docker/app/scripts/deploy.sh

CMD ./docker/app/scripts/deploy.sh


FROM php:8.0-alpine as base-cli

ARG PHP_EXTS

WORKDIR /var/www

RUN apk update && apk add  --no-cache libzip-dev zip libpq-dev postgresql-dev

RUN apk add --virtual build-dependencies --no-cache ${PHPIZE_DEPS} openssl ca-certificates libpq-dev libxml2-dev oniguruma-dev && \
    docker-php-ext-install -j$(nproc) ${PHP_EXTS}
RUN apk del build-dependencies

COPY --from=app-base --chown=www-data /var/www /var/www


#FROM base-cli as app-migrator
#
#RUN chmod +x docker/app/migrator.sh
#
#CMD ./docker/app/scripts/migrator.sh


FROM nginx:1.21-alpine as web

WORKDIR /var/www

COPY docker/web/confs/default.conf.template /etc/nginx/templates/default.conf.template

COPY --from=app-base /var/www/public/index.php /var/www/public/index.php
