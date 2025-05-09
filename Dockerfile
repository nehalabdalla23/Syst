# 1. استخدم صورة PHP الرسمية مع Apache
FROM php:8.2-apache

# 2. تثبيت المتطلبات
RUN apt-get update && apt-get install -y \
    git unzip zip curl \
    libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd

# 3. تثبيت Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 4. ضبط مجلد العمل
WORKDIR /var/www/html

# 5. نسخ ملفات المشروع
COPY . .

# 6. ضبط صلاحيات Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# 7. تعديل إعداد Apache لدعم Laravel
RUN bash -c 'cat > /etc/apache2/sites-available/000-default.conf <<EOF
<VirtualHost *:8080>
    DocumentRoot /var/www/html/public
    <Directory /var/www/html/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
EOF'

# 8. تفعيل mod_rewrite
RUN a2enmod rewrite

# 9. فتح المنفذ
EXPOSE 8080

# 10. أمر التشغيل
CMD ["apache2-foreground"]
