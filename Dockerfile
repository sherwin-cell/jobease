FROM dunglas/frankenphp

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    curl

# Install PHP extensions
RUN install-php-extensions \
    pdo \
    pdo_mysql \
    gd \
    intl \
    zip \
    opcache \
    bcmath

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy application files
COPY . .

# Install dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Create storage and cache directories
RUN mkdir -p /app/storage/framework/cache/data
RUN mkdir -p /app/storage/framework/sessions
RUN mkdir -p /app/storage/framework/views
RUN mkdir -p /app/bootstrap/cache
RUN mkdir -p /app/storage/logs

# Set permissions
RUN chown -R www-data:www-data /app/storage
RUN chown -R www-data:www-data /app/bootstrap/cache
RUN chmod -R 775 /app/storage
RUN chmod -R 775 /app/bootstrap/cache

# Cache Laravel files
RUN php artisan config:cache || true
RUN php artisan route:cache || true
RUN php artisan view:cache || true

EXPOSE 80

# Start FrankenPHP
CMD ["frankenphp", "run"]