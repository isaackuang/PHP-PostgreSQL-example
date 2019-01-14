FROM isaackuang/openresty:1.13.6.1

RUN curl https://php.codecasts.rocks/php-alpine.rsa.pub -o /etc/apk/keys/php-alpine.rsa.pub && \
    echo "@php https://php.codecasts.rocks/v3.8/php-7.2" >> /etc/apk/repositories && \
    apk --no-cache --progress add \
    php7-fpm@php php7-cli@php php7-redis@php php7-curl@php \
    php7-pdo_pgsql@php php7-json@php php7-yaml

COPY docker-files/php/config /
