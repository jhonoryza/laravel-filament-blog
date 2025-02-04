FROM jhonoryza/frankenphp-pgsql:8.2 AS build

WORKDIR /app

COPY . ./

# Install dependencies menggunakan Composer
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-plugins --no-scripts --prefer-dist

# Install Node.js and npm
RUN curl -fsSL https://nodejs.org/dist/v20.14.0/node-v20.14.0-linux-x64.tar.xz | tar -xJ -C /usr/local --strip-components=1

# Install npm dependencies and build assets
RUN npm install
RUN npm run build

# Final stage
FROM jhonoryza/frankenphp-pgsql:8.2

WORKDIR /app

COPY . ./
COPY --from=build /app/public /app/public
COPY --from=build /app/bootstrap/ssr /app/bootstrap/ssr
COPY --from=build /usr/local/bin/node /usr/local/bin/node
COPY --from=build /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=build /app/node_modules /app/node_modules

# Install dependencies menggunakan Composer
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-plugins --no-scripts --prefer-dist

RUN rm -rf /root/.composer
RUN rm -rf ./git

# Install supervisord
RUN apt-get update && apt-get install -y supervisor

# Copy supervisord configuration
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Jalankan supervisord
CMD ["/usr/bin/supervisord"]
