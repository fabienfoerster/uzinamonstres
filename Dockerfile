FROM php:7.0-apache
COPY src/ /var/www/html
RUN chmod -R 777 /var/www/html
