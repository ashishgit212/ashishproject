FROM php:8.1-apache

# Enable mysqli
RUN docker-php-ext-install mysqli

# Copy project files INTO Apache root
COPY enquiry_project/ /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
