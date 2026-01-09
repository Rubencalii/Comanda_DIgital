FROM php:8.4-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar directorio de trabajo
WORKDIR /var/www/html

# Copiar código fuente
COPY . .

# Instalar dependencias de Composer (sin scripts en build)
RUN composer install --no-scripts --no-interaction --optimize-autoloader

# Permisos para cache y logs
RUN chown -R www-data:www-data var/

EXPOSE 9000
CMD ["php-fpm"]
