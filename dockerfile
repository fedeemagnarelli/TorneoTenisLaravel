# Instanciamos la imagen oficial de apache con php8 y pdo_mysql
FROM php:8.2-fpm

# Definimos el lugar de trabajo
WORKDIR /var/www/html

# Instalar las dependencias necesarias
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libbz2-dev \
    libssl-dev \
    libzip-dev \
    libjpeg-dev \
    libpng-dev \
    libwebp-dev \
    libmcrypt-dev \
    mariadb-client

# Instalar extensiones de PHP necesarias 
RUN docker-php-ext-install pdo pdo_mysql zip exif pcntl bcmath \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar los archivos del proyecto
COPY . .

# Instalar las dependencias de Laravel
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install

# Establecer permisos full
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 777 /var/www/html

# Exponer el puerto 9000
EXPOSE 9000

# Ejecutar el servidor de Apache
CMD ["php-fpm"]
