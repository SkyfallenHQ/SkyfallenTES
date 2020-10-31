FROM php:7.4-apache
EXPOSE 80
COPY ./src /var/www/html
RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli
RUN apt-get update
RUN apt-get install libzip-dev -y
RUN docker-php-ext-install zip
RUN docker-php-ext-enable zip
RUN a2enmod rewrite
RUN touch /usr/local/etc/php/conf.d/skymake.ini
RUN echo "output_buffering = 16384" >> /usr/local/etc/php/conf.d/skymake.ini
RUN echo "display_errors = off" >> /usr/local/etc/php/conf.d/skymake.ini
RUN echo "error_reporting = E_ERROR" >> /usr/local/etc/php/conf.d/skymake.ini