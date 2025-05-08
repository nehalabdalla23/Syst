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

# نسخ إعداد Apache لدعم Laravel
RUN bash -c 'cat > /etc/apache2/sites-available/000-default.conf <<EOF


# تفعيل Apache Rewrite Module
RUN a2enmod rewrite

# تثبيت Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# مسح الكاش وتشغيل الأوامر الأساسية
RUN php artisan config:clear && php artisan route:clear && php artisan view:clear

# فتح المنفذ 80 (المستخدم من Apache)
EXPOSE 80

# لا حاجة لـ CMD لأن Apache يعمل تلقائيًا
