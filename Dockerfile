FROM php:8.2-cli

# Install system dependencies & PHP extensions required for Laravel + Filament + SQLite + PDF
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libsqlite3-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_sqlite zip intl gd bcmath \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy composer files first for better layer caching
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Copy application source
COPY . .

# Ensure render-start.sh has Unix LF endings and execute permission
RUN sed -i 's/\r$//' render-start.sh && chmod +x render-start.sh

# Prepare storage & SQLite database directories
RUN mkdir -p database storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache public/uploads/varan-photos \
    && touch database/database.sqlite \
    && chmod -R 777 storage bootstrap/cache database public/uploads \
    && php artisan filament:assets || true

EXPOSE 10000

CMD ["./render-start.sh"]
