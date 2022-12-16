FROM php:8.2-cli-alpine3.16

ENV TZ=Europe/Minsk

ADD https://github.com/mlocati/docker-php-extension-installer/releases/download/1.5.51/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions

RUN apk add --update --no-cache \
    tzdata \
    bash \
    zip \
    shadow \
    ca-certificates \
    && groupmod -o -g 1000 www-data && usermod -o -u 1000 -g www-data www-data \
    && apk del shadow \
;

RUN install-php-extensions \
    mbstring \
    redis-5.3.6 \
;

RUN echo "date.timezone=$TZ" > "$PHP_INI_DIR/conf.d/date-time-zone.ini" && \
    mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
;

COPY docker/php-cli/config/php.ini /usr/local/etc/php/php.ini

COPY --chown=www-data:www-data app /var/www/html/

COPY docker/php-cli/entrypoint.sh /

WORKDIR /var/www/html

RUN chmod +x /entrypoint.sh \
    && rm -rf var \
    && mkdir -m 770 -p var \
    && chown -R www-data:www-data var

USER www-data

ENTRYPOINT ["/entrypoint.sh"]
