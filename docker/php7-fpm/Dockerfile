FROM php:7.2-fpm-alpine3.7
ARG TIMEZONE

# Set timezone
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone
RUN printf '[PHP]\ndate.timezone = "%s"\n' ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini

RUN "date"

RUN set -ex \
  && apk --no-cache add \
    zlib-dev \
    librdkafka-dev


RUN apk --no-cache add icu-dev

RUN docker-php-ext-install pdo zip intl bcmath
ADD --chown=82:82 ./ /var/www

# apcu
RUN docker-php-source extract \
    && apk add --no-cache --virtual .phpize-deps-configure $PHPIZE_DEPS \
    && pecl install rdkafka \
    && docker-php-ext-enable rdkafka \
    && apk del .phpize-deps-configure \
    && docker-php-source delete

WORKDIR /var/www
