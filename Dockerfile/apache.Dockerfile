FROM centos:7

MAINTAINER Iamck <thanhson_it201@yahoo.com>

ENV PHP_VER="php72"

WORKDIR /var/www/html

RUN yum install -y epel-release \
    && yum install -y http://rpms.remirepo.net/enterprise/remi-release-7.rpm \
    && yum install -y yum-utils \
    && yum-config-manager --enable remi-php72 \
    && yum update -y

RUN yum install -y httpd ${PHP_VER} ${PHP_VER}-php \
    ${PHP_VER}-php-xml ${PHP_VER}-php-json ${PHP_VER}-php-mbstring \
    ${PHP_VER}-php-mysqlnd ${PHP_VER}-php-pdo \
    ${PHP_VER}-php-gd ${PHP_VER}-php-bcmatch \
    ${PHP_VER}-php-opcache

RUN yum install -y ${PHP_VER}-php-pecl-xdebug ${PHP_VER}-php-pecl-apcu ${PHP_VER}-php-pecl-redis

RUN ln -s /usr/bin/${PHP_VER} /usr/bin/php

CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]
