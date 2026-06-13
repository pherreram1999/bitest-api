# syntax=docker/dockerfile:1.7
#
# bitets-api — Laravel 13 + FrankenPHP (Octane) + MySQL
# Patrón oficial: https://laravel.com/docs/13.x/octane#frankenphp-via-docker
#
# Build:   docker build -t saets .
# Run:     docker run --rm -p 8000:8000 saets --host=0.0.0.0 --port=8000 --workers=4
#
# El entrypoint (docker/entrypoint.sh) copia .env.example a .env y autogenera
# APP_KEY si no viene por entorno.

FROM dunglas/frankenphp

# Headers para compilar ext-intl, ext-zip y ext-gd (mpdf)
RUN apt-get update && apt-get install -y --no-install-recommends \
        libicu-dev libzip-dev libpng-dev libjpeg62-turbo-dev libfreetype6-dev \
    && rm -rf /var/lib/apt/lists/*

# pcntl → Octane (SIGINT/SIGTERM/SIGHUP)
# intl  → filament/support
# zip   → openspout/openspout
# gd    → mpdf/mpdf
RUN install-php-extensions \
        pcntl \
        intl \
        zip \
        gd

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

WORKDIR /app

# composer.json/lock primero → cache de vendor
COPY composer.json composer.lock ./
RUN composer install \
        --no-dev \
        --no-scripts \
        --no-autoloader \
        --prefer-dist \
        --no-interaction \
        --no-progress

# Resto del código (incluye docker/entrypoint.sh)
COPY . .

RUN composer install \
        --no-dev \
        --no-interaction \
        --no-progress \
        --prefer-dist \
    && composer dump-autoload --optimize --classmap-authoritative --no-dev

# storage y bootstrap/cache deben ser escribibles
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

EXPOSE 8000 2019

ENTRYPOINT ["/app/docker/entrypoint.sh"]
CMD ["php", "artisan", "octane:frankenphp", "--host=0.0.0.0", "--port=8000", "--workers=4", "--max-requests=1000"]
