# FROM php:8.2-apache

# # Install system dependencies and PHP extensions
# RUN apt-get update && apt-get install -y \
#     git \
#     unzip \
#     curl \
#     zip \
#     libpng-dev \
#     libonig-dev \
#     libzip-dev \
#     libxml2-dev \
#     && docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# # Enable Apache rewrite module
# RUN a2enmod rewrite

# # Set working directory
# WORKDIR /var/www/html

# # Copy Composer from official image
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# # Copy application files
# COPY . .

# # Set correct document root to /public
# ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
# RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf \
#     && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# # Install Composer dependencies (optimize for production)
# RUN composer install --no-dev --optimize-autoloader

# # Generate Laravel APP_KEY if missing (won’t override existing)
# RUN if [ ! -f .env ]; then cp .env.example .env; fi && \
#     php artisan key:generate && \
#     php artisan config:cache

# # Fix Laravel folder permissions
# RUN chown -R www-data:www-data /var/www/html && \
#     chmod -R 775 storage bootstrap/cache

# # Expose port
# EXPOSE 80

# # Start Apache in foreground
# CMD ["apache2-foreground"]
# Stage 1: Composer
FROM composer:latest AS composerStage

# Stage 2: Laravel with Apache
FROM php:8.2-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    zip \
    libpng-dev \
    libonig-dev \
    libzip-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy Composer from composerStage
COPY --from=composerStage /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . .

# Set correct document root to /public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# Install Composer dependencies (optimize for production)
RUN composer install --no-dev --optimize-autoloader

# Generate Laravel APP_KEY if missing
RUN if [ ! -f .env ]; then cp .env.example .env; fi && \
    php artisan key:generate && \
    php artisan config:cache

# Fix Laravel folder permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 775 storage bootstrap/cache

# Expose port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
