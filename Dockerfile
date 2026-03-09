FROM wordpress:php8.2-apache

# Install additional PHP extensions if needed
RUN apt-get update && apt-get install -y \
    && rm -rf /var/lib/apt/lists/*

# Copy custom PHP configuration if needed
# COPY php.ini /usr/local/etc/php/conf.d/custom.ini

# Set working directory
WORKDIR /var/www/html

# WordPress files will be mounted as volume, so we don't copy them here
# This allows for live code changes
