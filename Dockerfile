# Utilise une image PHP officielle avec Composer
FROM php:8.2-fpm

# Installe les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Installe les extensions PHP nécessaires à Laravel
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Met à jour Composer
RUN composer self-update

# Installe Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crée un dossier pour l’application
WORKDIR /var/www

# Copie les fichiers du projet dans le conteneur
COPY . .

# Change les permissions des fichiers pour éviter les problèmes
RUN chown -R www-data:www-data /var/www

# Installe les dépendances Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Expose le port 9000 (PHP-FPM)
EXPOSE 9000

# Commande par défaut
CMD ["php-fpm"]
