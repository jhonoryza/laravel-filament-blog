FROM dunglas/frankenphp:latest-php8.2

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# RUN apt update -y
# RUN apt-get install -y libpq-dev
# RUN docker-php-ext-install pgsql pdo_pgsql

# Install dependencies untuk Composer dan ekstensi PHP
RUN apt-get update && apt-get install -y \
    curl \
    php-cli \
    php-zip \
    git \
    unzip \
    libpq-dev \
    libexif-dev \
    libsodium-dev \
    && apt-get clean

RUN install-php-extensions \
    pgsql \
    pdo_pgsql \
    gd \
    intl \
    zip \
    exif \
    sodium