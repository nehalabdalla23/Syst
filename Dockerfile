FROM php:8.2-apache

# تثبيت الامتدادات المطلوبة
RUN apt-get update && apt-get install -y \
    git unzip zip curl libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql zip gd

# تثبيت Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# صلاحيات Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# إعداد Apache لتوجيه إلى public
# نسخ إعداد Apache لدعم Laravel
RUN bash -c 'cat > /etc/apache2/sites-available/000-default.conf <<EOF
<VirtualHost *:80>
    DocumentRoot /var/www/html/public
    <Directory /var/www/html/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
EOF'

# تفعيل mod_rewrite
RUN a2enmod rewrite

# إعداد Laravel
RUN composer install --no-dev --optimize-autoloader \
    && php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear

EXPOSE 80
