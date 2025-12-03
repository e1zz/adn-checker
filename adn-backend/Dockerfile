# Imagen base PHP-FPM para producción
FROM php:8.2-fpm

# Instalar dependencias del sistema y extensiones de PHP necesarias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo dentro del contenedor
WORKDIR /var/www/html

# Copiar solo composer.json y composer.lock para cachear dependencias
COPY laravel-backend/composer.json laravel-backend/composer.lock ./

# Instalar dependencias
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Copiar el resto del proyecto
COPY laravel-backend/ .

# Establecer permisos (importante para producción)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Exponer el puerto de PHP-FPM
EXPOSE 8000

# Comando por defecto
CMD ["php-fpm"]
