FROM jhonoryza/frankenphp-pgsql:8.2

WORKDIR /app

COPY . ./

# Install dependencies menggunakan Composer
RUN composer install --no-dev --optimize-autoloader

RUN rm -rf ./git

# Jalankan FrankenPHP
ENTRYPOINT ["php", "artisan", "octane:frankenphp"]