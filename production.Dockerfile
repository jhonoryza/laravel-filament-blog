FROM dunglas/frankenphp:latest-php8.2

RUN apt update -y
RUN apt-get install -y libpq-dev
RUN docker-php-ext-install pgsql pdo_pgsql
RUN apt-get install -y zip libzip-dev libicu-dev
RUN docker-php-ext-configure intl
RUN docker-php-ext-install zip exif intl

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN mv composer.phar /usr/local/bin/composer

WORKDIR /app
COPY . ./

RUN composer install --no-dev
RUN rm -rf ./git
