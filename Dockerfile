FROM limogin/php-7.1-apache

COPY . /srv/app

RUN apt-get update && \
    apt-get install -y --no-install-recommends git

RUN chown -R www-data:www-data /srv/app \
    && a2enmod rewrite

WORKDIR /srv/app

RUN curl --silent --show-error https://getcomposer.org/installer | php

RUN php composer.phar install --no-dev

EXPOSE 5672

ENTRYPOINT cp ./vhost.conf /etc/apache2/sites-available/000-default.conf \
            && service apache2 stop && service apache2 start \
            && tailf /var/log/apache2/error.log
