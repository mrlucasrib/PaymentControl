FROM php:7.4-apache-buster as www
    RUN a2enmod rewrite
    RUN apt update && apt install -y libpq-dev
    RUN docker-php-ext-install mysqli pdo pdo_pgsql
    ENV DATABASE_URL=postgres://pguser:pgpass@db:5432/pgdata
    
