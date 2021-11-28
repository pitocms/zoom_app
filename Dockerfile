FROM php:7.4-apache
WORKDIR /var/www/html
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN apt-get update -y && apt-get install -y unzip zip
RUN docker-php-ext-install mysqli

RUN  mv /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled \
 && /bin/sh -c a2enmod rewrite
 
COPY . .
RUN composer i -n -o --prefer-dist