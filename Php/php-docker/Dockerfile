FROM php:5.6-apache

WORKDIR /var/www/html

RUN apt-get update -y && apt-get install -y libmariadb-dev
RUN docker-php-ext-install mysqli pdo_mysql intl mbstring