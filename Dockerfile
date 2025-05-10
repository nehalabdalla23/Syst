# Use official PHP image with required extensions
FROM php:8.2-cli

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libpng-dev libonig-dev libxml2-dev \
    libjpeg-dev libfreetype6-dev libpq-dev libcurl4-openssl-dev \
    nodejs npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy composer files and install PHP dependencies
COPY composer.json composer.lock ./
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Copy frontend package files and install NPM dependencies
COPY package.json package-lock.json ./
RUN npm install

# Copy the rest of the application code
COPY . .

# Copy default .env (you can override in Railway later)
RUN cp .env.example .env || true

# Generate Laravel APP_KEY if not set
RUN if ! grep -q '^APP_KEY=' .env || [ -z "$(grep '^APP_KEY=' .env | cut -d '=' -f2)" ]; then \
    php artisan key:generate; fi

# Build frontend (Vite)
RUN npm run build

# Clear caches
RUN php artisan config:clear && php artisan cache:clear && php artisan route:clear

# Set correct permissions
RUN chmod -R 775 storage bootstrap/cache

# Expose port Laravel will serve on
EXPOSE 8000

# Run Laravel dev server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
