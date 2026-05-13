FROM webdevops/php-nginx:8.4

# Install Node.js + git + unzip
RUN apt-get update && apt-get install -y \
    nodejs \
    npm \
    git \
    unzip \
    zip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Add queue worker to supervisor
# Add queue worker to supervisor
RUN mkdir -p /etc/supervisor/conf.d && \
    echo '[program:queue-worker]\ncommand=php /var/www/html/artisan queue:work --tries=3 --sleep=3 --timeout=60\nautostart=true\nautorestart=true\nstdout_logfile=/dev/stdout\nstdout_logfile_maxbytes=0\nstderr_logfile=/dev/stderr\nstderr_logfile_maxbytes=0\n' \
    > /etc/supervisor/conf.d/queue-worker.conf

# Set working directory
WORKDIR /var/www/html

# Copy composer files first (layer caching)
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy package files first (layer caching)
COPY package.json package-lock.json ./
RUN npm ci

# Copy rest of app
COPY . .

# Build frontend + dump autoload
RUN npm run build \
    && composer dump-autoload --optimize

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 777 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache \
    && mkdir -p /var/www/html/storage/logs

# webdevops image env config
ENV WEB_DOCUMENT_ROOT=/var/www/html/public
ENV PHP_DISPLAY_ERRORS=0
ENV PHP_MEMORY_LIMIT=256M

EXPOSE 80