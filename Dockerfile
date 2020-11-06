FROM php:7.4-apache as www
    RUN a2enmod rewrite
    RUN docker-php-ext-install mysqli pdo pdo_mysql
   
