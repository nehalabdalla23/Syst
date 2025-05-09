# صورة أساسية
FROM php:8.2-apache

# إعداد ملف Apache VirtualHost
RUN bash -c 'cat > /etc/apache2/sites-available/000-default.conf <<EOF
<VirtualHost *:8000>
    DocumentRoot /var/www/html/public
    <Directory /var/www/html/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
EOF'

# تفعيل mod_rewrite
RUN a2enmod rewrite

# فتح المنفذ
EXPOSE 8000

# تشغيل Apache
CMD ["apache2-foreground"]
