FROM php:8.2-apache

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copia composer.json y composer.lock primero (para aprovechar el cache)
COPY public/composer.json /var/www/html/composer.json
# Si tienes composer.lock, descomenta la siguiente línea
COPY public/composer.lock /var/www/html/composer.lock

WORKDIR /var/www/html

# Instala dependencias de Composer
RUN composer install --no-dev --no-interaction --prefer-dist

# Copia el resto del código fuente
COPY public/ /var/www/html/

# Permisos opcionales
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80