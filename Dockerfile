FROM php:8.2-apache

# Install ekstensi PHP
RUN apt-get update && \
    apt-get install -y libicu-dev && \
    docker-php-ext-install intl mysqli pdo pdo_mysql

# Aktifkan mod_rewrite
RUN a2enmod rewrite

# Atur DocumentRoot ke public/ secara eksplisit
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Tambahkan juga <Directory> agar bisa rewrite
RUN echo '<Directory /var/www/html/public>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' >> /etc/apache2/apache2.conf

# Salin semua file project ke image
COPY . /var/www/html

# Set permission
RUN chown -R www-data:www-data /var/www/html

# Direktori kerja
WORKDIR /var/www/html



