FROM dunglas/frankenphp:latest-php8.2

RUN apt update -y
RUN apt-get install -y libpq-dev
RUN docker-php-ext-install pgsql pdo_pgsql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
