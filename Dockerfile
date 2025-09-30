FROM php:8.2-apache

# Instalar dependencias necesarias para mysqli y extensiones
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli pdo_mysql

# Activar mod_rewrite si lo necesitas
RUN a2enmod rewrite