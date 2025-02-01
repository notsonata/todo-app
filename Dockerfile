# PHP Apache Dockerfile
FROM php:8.2-apache

# Install PHP extensions and other dependencies
RUN docker-php-ext-install mysqli pdo pdo_mysql && \
    a2enmod rewrite && \
    apt-get update && \
    apt-get install -y zip unzip

# Set working directory
WORKDIR /var/www/html

# Apache configuration to enable .htaccess
RUN echo '<Directory /var/www/html>\n\
    AllowOverride All\n\
</Directory>' >> /etc/apache2/apache2.conf