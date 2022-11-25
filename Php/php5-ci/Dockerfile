FROM php:5.6-apache	
COPY . /var/www/html
RUN apt-get update -y && apt-get install -y openssl zip unzip git
RUN docker-php-ext-install pdo mbstring mysqli pdo_mysql
