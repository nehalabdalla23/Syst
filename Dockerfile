FROM php:8.1-fpm

# تثبيت الحزم الأساسية مثل git و unzip و zip
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_mysql

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# نسخ الملفات إلى الحاوية
COPY . .

# تثبيت الاعتمادات
RUN composer install --no-dev --optimize-autoloader

# ضبط أذونات الملفات
RUN chown -R www-data:www-data /var/www/html

EXPOSE 9000
CMD ["php-fpm"]

