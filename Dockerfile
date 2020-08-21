FROM php:7.2-apache

RUN apt-get update && apt-get install -y

# Install php mysqli, pdo_mysql extensions & enable mod_rewrite in apache2
RUN docker-php-ext-install mysqli pdo_mysql \
    && a2enmod rewrite

RUN mkdir /app && \
    mkdir /app/docker-codeigniter && \
    mkdir /app/docker-codeigniter/www

COPY www/ /app/docker-codeigniter/www/

RUN cp -r /app/docker-codeigniter/www/* /var/www/html/.
