FROM php:7.2-apache


RUN apt-get update \
    && apt-get install git libmcrypt-dev libzip-dev --yes

# RUN docker-php-ext-install \
#     mysqli \
#     pdo \
#     pdo_mysql \
#     zip \
#     mcrypt

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer