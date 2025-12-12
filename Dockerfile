FROM php:8.2-apache

# Install mysqli and other common PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy your app into the container
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Expose default Apache port
EXPOSE 80
