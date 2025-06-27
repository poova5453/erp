FROM php:8.2-apache

<<<<<<< Updated upstream
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
=======
# Install PHP extensions
RUN apt-get update && apt-get install -y \\
    unzip zip curl git libzip-dev libpng-dev libonig-dev libxml2-dev \\
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# Enable Apache rewrite
>>>>>>> Stashed changes
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

<<<<<<< Updated upstream
# Copy Composer from official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . .

# Set correct document root to /public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# Install Composer dependencies (optimize for production)
RUN composer install --no-dev --optimize-autoloader

# Generate Laravel APP_KEY if missing (won't override existing)
RUN if [ ! -f .env ]; then cp .env.example .env; fi && \
    php artisan key:generate && \
    php artisan config:cache

# Fix Laravel folder permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 775 storage bootstrap/cache

# Expose port
EXPOSE 80

# Start Apache in foreground
=======
# Install Composer manually (fallback)
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

# Copy files
COPY . .

# Install Laravel dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Apache to serve public folder
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf

# Permissions
RUN chown -R www-data:www-data /var/www/html \\
    && chmod -R 775 storage bootstrap/cache

EXPOSE 80

>>>>>>> Stashed changes
CMD ["apache2-foreground"]
