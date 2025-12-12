# Use the official PHP 8.2 Apache image
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install required packages for PostgreSQL PDO and other common PHP extensions
RUN apt-get update && \
    apt-get install -y libpq-dev zip unzip git && \
    docker-php-ext-install pdo pdo_pgsql

# Enable Apache mod_rewrite (optional, but useful for friendly URLs)
RUN a2enmod rewrite

# Copy your app into the container
COPY . /var/www/html/

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
