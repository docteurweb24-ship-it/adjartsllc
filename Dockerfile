FROM php:8.2-cli

WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    && docker-php-ext-install pdo pdo_mysql zip bcmath

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
 && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
 && rm composer-setup.php

# Copy composer files first to leverage layer cache
COPY composer.json composer.lock* ./
RUN if [ -f composer.json ]; then composer install --no-dev --prefer-dist --no-interaction --no-scripts; fi

# Copy the application
COPY . .

# Ensure permissions (best-effort)
RUN chown -R www-data:www-data /var/www/html || true

ENV PORT 8080
EXPOSE 8080

# Use the built-in server for simplicity (not for heavy production).
CMD php artisan serve --host 0.0.0.0 --port ${PORT}
