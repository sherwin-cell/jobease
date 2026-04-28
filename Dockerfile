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
RUN mkdir -p /app/storage/framework/cache/data \
    && mkdir -p /app/storage/framework/sessions \
    && mkdir -p /app/storage/framework/views \
    && mkdir -p /app/bootstrap/cache \
    && mkdir -p /app/storage/logs

# Set permissions
RUN chown -R www-data:www-data /app/storage \
    && chown -R www-data:www-data /app/bootstrap/cache \
    && chmod -R 775 /app/storage \
    && chmod -R 775 /app/bootstrap/cache

# Cache Laravel files
RUN php artisan config:cache || true \
    && php artisan route:cache || true \
    && php artisan view:cache || true

EXPOSE 80

# Override and clear the entrypoint, then use PHP's built-in server
ENTRYPOINT []
CMD php artisan serve --host=0.0.0.0 --port=80