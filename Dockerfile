FROM dunglas/frankenphp:latest-php8.2

# Install dependencies untuk Composer dan ekstensi PHP
RUN apt-get update && apt-get install -y \
    curl \
    php-cli \
    php-zip \
    git \
    unzip \
    libpq-dev \
    libexif-dev \
    libsodium-dev

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN install-php-extensions \
    pgsql \
    pdo_pgsql \
    gd \
    intl \
    zip \
    exif \
    sodium