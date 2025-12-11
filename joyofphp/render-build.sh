#!/usr/bin/env bash
set -e

# Update system
apt-get update -y

# Install PHP + MySQL driver
apt-get install -y \
    php \
    php-cli \
    php-mysql \
    php-mysqli \
    php-gd \
    php-curl \
    php-zip \
    php-xml \
    php-mbstring
