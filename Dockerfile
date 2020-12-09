FROM php:7.4-apache

WORKDIR /var/www/

RUN rm -fR html

# On installe git
RUN apt-get update \
    && apt-get install -y --no-install-recommends git

COPY . .

# on télécharge et deplace le composer
RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
    mv composer.phar /usr/local/bin/composer && \
    composer install