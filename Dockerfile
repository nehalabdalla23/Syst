# استخدم صورة PHP الرسمية مع Apache
FROM php:8.2-apache

# تثبيت الأدوات الأساسية وامتدادات PHP اللازمة للـ Laravel
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

# إعداد مجلد العمل داخل الحاوية
WORKDIR /var/www/html

# نسخ جميع الملفات من مشروعك إلى الحاوية
COPY . .

# ضبط صلاحيات مجلدات Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# إعداد Apache لدعم Laravel (توجيه Apache للـ public)
RUN bash -c 'cat > /etc/apache2/sites-available/000-default.conf <<EOF
<VirtualHost *:80>
    DocumentRoot /var/www/html/public
    <Directory /var/www/html/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
EOF'

# تفعيل Apache mod_rewrite
RUN a2enmod rewrite

# تثبيت الـ dependencies باستخدام Composer
RUN composer install --no-dev --optimize-autoloader

# مسح الكاش وتشغيل الأوامر الأساسية للـ Laravel
RUN php artisan config:clear && php artisan route:clear && php artisan view:clear

# فتح المنفذ 80
EXPOSE 80

# تشغيل Apache عند بدء الحاوية
CMD ["apache2-foreground"]
