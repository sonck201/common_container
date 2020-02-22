FROM php:7.2

LABEL MAINTAINER iamck<thanhson201@gmail.com>

RUN apt-get update && apt-get install -y
RUN docker-php-ext-install pdo pdo_mysql
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug pdo