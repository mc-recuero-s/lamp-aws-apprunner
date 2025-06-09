FROM php:8.2-apache
ARG DEBIAN_FRONTEND=noninteractive

RUN docker-php-ext-install mysqli
RUN apt update \
    && apt install libzip-dev zlib1g-dev -y \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install zip
RUN a2enmod rewrite

WORKDIR /var/www/html

# Copia el resto del código fuente
COPY public/ /var/www/html/

# Permisos opcionales
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80