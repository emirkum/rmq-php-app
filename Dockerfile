FROM ulsmith/alpine-apache-php7

COPY . /app/

RUN chown -R apache:apache /app/

ADD https://php.codecasts.rocks/php-alpine.rsa.pub /etc/apk/keys/php-alpine.rsa.pub
RUN apk --update add ca-certificates
RUN echo "@php https://php.codecasts.rocks/v3.8/php-7.2" >> /etc/apk/repositories
RUN apk add --update php@php
RUN apk add --update php-mbstring@php

WORKDIR /app

RUN curl --silent --show-error https://getcomposer.org/installer | php

RUN php -v && php composer.phar install --no-dev

EXPOSE 5672