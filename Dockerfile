FROM php:8.2-fpm

# Installe les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Installe les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Installe Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Dossier de l'app
WORKDIR /var/www

# Copier uniquement composer pour installer plus vite avec cache Docker
COPY composer.lock composer.json ./

# Installer les dépendances Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Copier tout le code
COPY . .

# Permissions Laravel
RUN mkdir -p storage/framework/cache/data && \
    chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]
