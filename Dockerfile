
FROM php:8.2-apache




# نسخ Composer من صورة أخرى
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# تعيين مجلد العمل
WORKDIR /var/www/html

# نسخ المشروع إلى الحاوية
COPY . .

# إعطاء صلاحيات للمجلدات
RUN chown -R www-data:www-data storage bootstrap/cache

# تفعيل Apache Rewrite
RUN a2enmod rewrite

# تفعيل إعداد Apache لدعم Laravel
RUN echo '<VirtualHost *:80>
    DocumentRoot /var/www/html/public
    <Directory /var/www/html/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# تثبيت Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# تنظيف الكاش
RUN php artisan config:clear && php artisan route:clear && php artisan view:clear

# فتح المنفذ 80
EXPOSE 80

# الأمر الأساسي لتشغيل Apache
CMD ["apache2-foreground"]
