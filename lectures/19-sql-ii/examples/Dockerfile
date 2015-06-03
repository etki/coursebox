FROM php:5.6-fpm
MAINTAINER Etki etki@etki.name

RUN apt-get update -yqq && apt-get install libpq-dev libmysqlclient-dev -yqq
# libsqlite3-dev

RUN docker-php-ext-install pdo_pgsql pdo_mysql

ADD src /var/www/html