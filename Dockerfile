# Use the official PHP 8.2 Apache image
FROM php:8.2-apache

# 1. Install system dependencies for Laravel and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl

# 2. Clear out the local apt cache to keep the image small
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# 3. Install required PHP extensions for Laravel & Filament
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# 4. Enable Apache mod_rewrite for Laravel's pretty URLs
RUN a2enmod rewrite

# 5. Set the Document Root to Laravel's /public folder
# This is crucial so Apache looks for index.php in the right place
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 6. Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 7. Copy the application code into the container
COPY . /var/www/html

# 8. Set the working directory
WORKDIR /var/www/html

# 9. Install PHP dependencies
# --no-dev: Excludes testing/development tools
# --optimize-autoloader: Speeds up class loading (fixes your autoload.php error)
RUN composer install --no-interaction --optimize-autoloader --no-dev

# 10. Set correct permissions for Laravel storage and cache
# Failure to do this often causes 500 errors on Render
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 11. Expose port 80 for Render
EXPOSE 80

# Apache runs in the foreground by default in this image
