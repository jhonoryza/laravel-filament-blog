FROM dunglas/frankenphp:latest-php8.2

RUN apt update -y
RUN apt-get install -y libpq-dev
RUN docker-php-ext-install pgsql pdo_pgsql
