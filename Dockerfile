FROM php:7.4.7-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql