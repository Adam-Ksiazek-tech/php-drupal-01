FROM php:8.1-apache

# Wymagane biblioteki systemowe + gd
RUN apt-get update && apt-get install -y \
    libzip-dev unzip libonig-dev libxml2-dev libjpeg-dev libpng-dev libfreetype6-dev git curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install zip pdo pdo_mysql mbstring xml gd \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Włączenie mod_rewrite dla Apache
RUN a2enmod rewrite

# Ustawienia Apache dla Drupala
COPY ./apache/drupal.conf /etc/apache2/sites-available/000-default.conf

# Ustawienia katalogu roboczego
WORKDIR /var/www/html

ENV PATH="/var/www/html/vendor/bin:${PATH}"