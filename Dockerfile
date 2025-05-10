# المرحلة الأولى: إعداد Laravel
FROM php:8.2-cli

# تثبيت التبعيات المطلوبة
RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    git \
    zip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring gd

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# تحديد مجلد العمل
WORKDIR /app

# نسخ ملفات المشروع
COPY . .

# تثبيت مكتبات Laravel
RUN composer install --no-dev --optimize-autoloader

# إعطاء صلاحيات مناسبة
RUN chmod -R 775 storage bootstrap/cache

# تعيين المنفذ
EXPOSE 8080

# أمر التشغيل الرئيسي
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=${PORT:-8080}"]
