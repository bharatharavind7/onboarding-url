FROM php:8.2-apache

RUN a2enmod rewrite
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

# Copy everything to Apache root
COPY . /var/www/html/

# JSON file must be writable
RUN chmod 777 /var/www/html/wsp-agencies.json
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
