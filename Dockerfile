# Étape 1 : image officielle PHP avec FPM
FROM php:8.2-fpm

# Étape 2 : Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Étape 3 : Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Étape 4 : Créer le dossier de l'application
WORKDIR /var/www

# Étape 5 : Copier les fichiers du projet dans le conteneur
COPY . .

# Étape 6 : Donner les permissions
RUN chown -R www-data:www-data /var/www

# Étape 7 : Installer les dépendances Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Expose le port 9000 (utilisé par php-fpm)
EXPOSE 9000

# Commande de démarrage par défaut
CMD ["php-fpm"]
