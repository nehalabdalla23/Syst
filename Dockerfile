# استخدم صورة PHP الرسمية مع Apache
FROM php:8.2-apache

# تثبيت الأدوات الأساسية وامتدادات PHP اللازمة لـ Laravel
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

# تعيين مجلد العمل
WORKDIR /var/www/html

# نسخ ملفات Laravel إلى الحاوية
COPY . .

# إعطاء صلاحيات للمجلدات المهمة
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# نسخ إعداد Apache لدعم Laravel (مغلف بطريقة صحيحة)
RUN bash -c "cat <<EOF > /etc/apache2/sites-available/000-default.conf
<VirtualHost *:80>
    DocumentRoot /var/www/html/public
    <Directory /var/www/html/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
EOF"

# تفعيل Apache mod_rewrite
RUN a2enmod rewrite

# تحميل dependencies Laravel
RUN composer install --no-dev --optimize-autoloader

# تنظيف الكاش
RUN php artisan config:clear && php artisan route:clear && php artisan view:clear

# فتح المنفذ 80
EXPOSE 80

# الأمر الأساسي لتشغيل Apache (وليس php artisan serve)
CMD ["apache2-foreground"]
