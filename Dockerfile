# Use an official PHP runtime as the base image
FROM php:latest

# Set the working directory in the container
WORKDIR /var/www/html

# Copy the composer.json and composer.lock files to the container
COPY composer.json composer.lock ./

# Install PHP extensions and Composer
RUN apt-get update \
    && apt-get install -y zip unzip libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install application dependencies
# RUN composer install --no-scripts --no-autoloader


# Rename index.php to google_map.php
# RUN mv index.php google_map.php

# Generate the Composer autoload file
# RUN composer dump-autoload --optimize

# Copy the rest of the application code to the container
COPY . /var/www/html

# Expose the port your PHP application runs on
EXPOSE 80

# Start the PHP development server
CMD ["php", "-S", "0.0.0.0:80"]
