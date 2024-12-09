FROM jhonoryza/frankenphp-pgsql:8.2

WORKDIR /app

COPY . ./

# Install dependencies menggunakan Composer
RUN composer install --no-dev --optimize-autoloader

RUN rm -rf ./git

# Salin konfigurasi Caddyfile dan file environment
COPY Caddyfile /etc/caddy/Caddyfile
COPY caddy.env /etc/caddy/caddy.env

# Expose port untuk akses aplikasi
EXPOSE 80

# Jalankan FrankenPHP
CMD ["caddy", "run", "--config", "/etc/caddy/Caddyfile", "--adapter", "caddyfile"]