 
FROM php:8.2-apache 
 
RUN apt-get update && apt-get install -y git unzip libzip-dev zip && docker-php-ext-install pdo pdo_mysql zip 
 
RUN curl -sL https://deb.nodesource.com/setup_20.x | bash - && apt-get install -y nodejs 
 
COPY . /var/www/html 
 
COPY ./docker/apache.conf /etc/apache2/sites-available/000-default.conf 
 
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && cd /var/www/html && composer install --no-dev --optimize-autoloader 
 
RUN cd /var/www/html && npm install && npm run build 
 
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache 
 
RUN a2enmod rewrite 
 
EXPOSE 80 
 
CMD ["apache2-foreground"] 
