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
