FROM jhonoryza/frankenphp-pgsql:8.2

# Install Caddy dengan repository resmi, menonaktifkan prompt interaktif
RUN export DEBIAN_FRONTEND=noninteractive && \
    curl -fsSL https://dl.cloudsmith.io/public/caddy/stable/deb/caddy-stable.deb | tee /etc/apt/sources.list.d/caddy-stable.list && \
    apt-get update && \
    apt-get install -y caddy

# Pastikan Caddy terpasang
RUN caddy version

WORKDIR /app

COPY . ./

# Install dependencies menggunakan Composer
RUN composer install --no-dev --optimize-autoloader

RUN rm -rf ./git

# Salin konfigurasi Caddyfile dan file environment
COPY default.Caddyfile /etc/caddy/Caddyfile
COPY caddy.env /etc/caddy/caddy.env

# Expose port untuk akses aplikasi
EXPOSE 80

# Jalankan FrankenPHP
CMD ["caddy", "run", "--config", "/etc/caddy/Caddyfile", "--adapter", "caddyfile"]