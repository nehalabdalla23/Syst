# استخدام صورة PHP مع Apache
FROM php:8.2-apache

# تثبيت الأدوات الضرورية وامتدادات PHP
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd

# تثبيت Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# تحديد مجلد العمل
WORKDIR /var/www/html

# نسخ ملفات المشروع
COPY . .

# ضبط صلاحيات Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# إعداد Apache لتوجيه الطلبات إلى public/
RUN bash -c "cat <<EOF > /etc/apache2/sites-available/000-default.conf
<VirtualHost *:80>
    DocumentRoot /var/www/html/public
    <Directory /var/www/html/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
EOF"

# تفعيل mod_rewrite
RUN a2enmod rewrite

# تثبيت مكتبات Laravel
RUN composer install --no-dev --optimize-autoloader

# تنظيف الكاش
RUN php artisan config:clear && php artisan route:clear && php artisan view:clear

# فتح المنفذ الافتراضي لـ Apache
EXPOSE 80

# بدء Apache
CMD ["apache2-foreground"]
