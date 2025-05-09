
FROM php:8.2-apache

RUN bash -c 'cat <<EOF > /etc/apache2/sites-available/000-default.conf
<VirtualHost *:8000>
    DocumentRoot /var/www/html/public
    <Directory /var/www/html/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
EOF'

