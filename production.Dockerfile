FROM jhonoryza/frankenphp-pgsql:8.2

# Install dependensi yang dibutuhkan
RUN apt-get update -y && apt-get install -y \
    curl \
    gnupg2 \
    lsb-release \
    libpq-dev

# Menambahkan kunci GPG untuk repository Caddy
RUN curl -fsSL https://dl.cloudsmith.io/public/caddy/stable/deb/gpg.key | tee /etc/apt/trusted.gpg.d/caddy.asc

# Menambahkan repository Caddy ke sources.list
RUN echo "deb https://dl.cloudsmith.io/public/caddy/stable/deb/debian/ $(lsb_release -c | awk '{print $2}') main" | tee /etc/apt/sources.list.d/caddy-stable.list

# Update apt-get dan install Caddy
RUN apt-get update && apt-get install -y caddy

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