# Base image
FROM php:8.0-fpm

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    nginx

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy project files
COPY . /var/www

# Install application dependencies
RUN composer install --optimize-autoloader --no-dev

# Generate application key
RUN php artisan key:generate

# Set folder permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Nginx configuration
COPY docker/nginx/default.conf /etc/nginx/sites-available/default

# Expose ports
EXPOSE 80

# Start PHP-FPM and Nginx
CMD service php8.0-fpm start && nginx -g "daemon off;"

