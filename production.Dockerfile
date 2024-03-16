FROM dunglas/frankenphp:latest-php8.2

RUN apt update -y
RUN apt-get install -y libpq-dev
RUN docker-php-ext-install pgsql pdo_pgsql
RUN apt-get install -y zip libzip-dev libicu-dev
RUN docker-php-ext-configure intl
RUN docker-php-ext-install zip exif intl

RUN apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libgd-dev \
    jpegoptim optipng pngquant gifsicle \
    libonig-dev \
    libxml2-dev

RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN mv composer.phar /usr/local/bin/composer

WORKDIR /app
COPY . ./

RUN composer install --no-dev
RUN rm -rf ./git
