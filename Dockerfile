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
    libmcrypt-dev \
    curl \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath gd

# تثبيت Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ضبط مجلد التطبيق
WORKDIR /var/www/html

# نسخ ملفات Laravel إلى حاوية العمل
COPY . .

# إعداد صلاحيات التخزين
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# نسخ إعداد Apache لدعم Laravel
RUN bash -c "cat > /etc/apache2/sites-available/000-default.conf << 'EOF'
<VirtualHost *:80>
    DocumentRoot /var/www/html/public
    <Directory /var/www/html/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
EOF"


# تفعيل Apache Rewrite Module
RUN a2enmod rewrite

# تحميل الـ dependencies
RUN composer install --no-dev --optimize-autoloader

# إعداد APP_KEY
RUN php artisan config:clear && php artisan route:clear && php artisan view:clear

# فتح المنفذ من البيئة (Railway يعطيه تلقائيًا)
ENV PORT=8080
EXPOSE ${PORT}

# الأمر الأساسي لتشغيل Laravel
CMD php artisan serve --host=0.0.0.0 --port=${PORT}
