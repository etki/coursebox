FROM php:5.6-fpm
MAINTAINER etki@etki.name

ENV ENVIRONMENT production
ENV TERM xterm

RUN echo "php_value[date.timezone] = Europe/Moscow" >> /usr/local/etc/php-fpm.conf

RUN echo "date.timezone = Europe/Moscow" >> /usr/local/etc/php/php.ini

RUN apt-get update

RUN apt-get install libmcrypt-dev zlib1g-dev git -yqq

RUN docker-php-ext-install pcntl mcrypt bcmath zip mbstring

RUN curl -o /usr/local/bin/composer https://getcomposer.org/composer.phar && chmod a+x /usr/local/bin/composer

ADD . /var/www/application

WORKDIR /var/www/application

RUN composer install --no-dev --no-interaction

RUN bin/console migrate up --interactive=0

RUN chown -R www-data:www-data /var/www/application

CMD ["php-fpm"]
