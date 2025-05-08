FROM php:8.2-apache

# تثبيت الأدوات الأساسية وامتدادات PHP
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    curl \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd

# تثبيت Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# إعداد مجلد العمل
WORKDIR /var/www/html

# نسخ ملفات Laravel إلى الحاوية
COPY . .

# ضبط صلاحيات مجلدات Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

RUN bash -c 'cat > /etc/apache2/sites-available/000-default.conf <<EOF

