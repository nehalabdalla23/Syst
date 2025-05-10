# استخدم صورة PHP الرسمية مع Apache
FROM php:8.1-apache

# تثبيت التوسعات اللازمة لـ Laravel
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_mysql

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# إعداد مجلد العمل
WORKDIR /var/www/html

# نسخ ملفات المشروع
COPY . .

# تثبيت الاعتمادات
RUN composer install --no-dev --optimize-autoloader

# ضبط أذونات الملفات
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
