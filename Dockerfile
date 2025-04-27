# Set the base image to use
FROM php:8.1-fpm

# Set working directory in the container
WORKDIR /var/www

# Install system dependencies for PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy the application code to the container
COPY . .

# Install Laravel dependencies
RUN composer install

# Expose port 9000 and start PHP-FPM
EXPOSE 9000
CMD ["php-fpm"]
