FROM php:5.6-apache

RUN sed -i s/deb.debian.org/archive.debian.org/g /etc/apt/sources.list
RUN sed -i 's|security.debian.org|archive.debian.org|g' /etc/apt/sources.list 
RUN sed -i '/stretch-updates/d' /etc/apt/sources.list
RUN apt update 
RUN apt install -y nano 
RUN docker-php-ext-install pdo pdo_mysql mysql mysqli 

EXPOSE 80

COPY docker/php.ini /usr/local/etc/php/
