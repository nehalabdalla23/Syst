# استخدم صورة PHP الرسمية مع Apache
FROM php:8.2-apache

# تثبيت الأدوات الأساسية وامتدادات PHP اللازمة للـ Laravel
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

# ضبط مجلد التطبيق
WORKDIR /var/www/html

# نسخ ملفات Laravel إلى حاوية العمل
COPY . .

# إعداد صلاحيات التخزين
RUN chown -R www-data:www-data storage bootstrap/cache

# نسخ إعداد Apache لدعم Laravel
RUN echo "<VirtualHost *:80>" > /etc/apache2/sites-available/000-default.conf && \
    echo "    DocumentRoot /var/www/html/public" >> /etc/apache2/sites-available/000-default.conf && \
    echo "    <Directory /var/www/html/public>" >> /etc/apache2/sites-available/000-default.conf && \
    echo "        AllowOverride All" >> /etc/apache2/sites-available/000-default.conf && \
    echo "        Require all granted" >> /etc/apache2/sites-available/000-default.conf && \
    echo "    </Directory>" >> /etc/apache2/sites-available/000-default.conf && \
    echo "</VirtualHost>" >> /etc/apache2/sites-available/000-default.conf

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
