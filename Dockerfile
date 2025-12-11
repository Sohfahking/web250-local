# Use the official PHP image with Apache as the base image
FROM php:8.2-apache

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy your application source code from your local machine to the container
COPY . .

# Optionally, enable Apache modules like rewrite (common for frameworks like Laravel)
# RUN a2enmod rewrite

# You might need to install PHP extensions here if your app uses them (e.g., pdo_pgsql for PostgreSQL)
# RUN docker-php-ext-install pdo pdo_pgsql

# The base image already handles starting the Apache server, so no CMD is strictly needed here.
# Render automatically uses port 80/443 by default for web services, but the image is often internally configured to listen on port 80
