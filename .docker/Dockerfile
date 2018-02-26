FROM php:7.2.2-apache

MAINTAINER marko424

#Create “/srv/app” folder
COPY . /srv/app
COPY vhost.conf /etc/apache2/sites-available/000-default.conf

#Set the working directory
WORKDIR /srv/app

RUN docker-php-ext-install mbstring pdo pdo_mysql \
    #Change ownership of the application files to
    #the Apache (make files writable by the Apache user)
    && chown -R www-data:www-data /srv/app \
    #Turn off warning - add line to the end of a file "ServerName localhost"
    && echo "ServerName localhost" | tee /etc/apache2/conf-available/fqdn.conf \
    && a2enconf fqdn \
    && service apache2 restart \
    && apache2ctl configtest \
    #Enable mod rewrite - .htaccess
    && a2enmod rewrite && service apache2 restart