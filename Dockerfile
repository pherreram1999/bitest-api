# syntax=docker/dockerfile:1.7
#
# Bitets API — Laravel 13 + FrankenPHP (Octane) + libsql/Turso
# Base: dunglas/frankenphp:php8.3-bookworm (FrankenPHP preinstalado, PHP 8.3 ZTS)
#
# Build:    docker build -t bitets-api .
# Run:      docker run --rm -p 8000:8000 --env-file .env bitets-api

ARG FRANKENPHP_IMAGE=dunglas/frankenphp:php8.3-bookworm
ARG APP_ENV=production

# ---------- Runtime ----------
FROM ${FRANKENPHP_IMAGE} AS runtime

ENV APP_ENV=${APP_ENV} \
    OCTANE_SERVER=frankenphp \
    PORT=8000 \
    PHP_OPCACHE_VALIDATE_TIMESTAMPS=0

# Entrypoint: genera/persiste APP_KEY y arranca el comando recibido.
# Ver docker/entrypoint.sh para la lógica completa.
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Dependencias del sistema:
#   git, unzip            → composer
#   ca-certificates       → TLS
#   libicu-dev, libzip-dev → headers para compilar ext-intl y ext-zip
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        unzip \
        ca-certificates \
        libicu-dev \
        libzip-dev \
    && rm -rf /var/lib/apt/lists/*

# Extensiones PHP requeridas por el proyecto:
#   ffi   → turso/libsql (AppServiceProvider::boot registra el driver)
#   intl  → filament/support
#   zip   → openspout/openspout
#   pcntl → Octane usa SIGINT/SIGTERM/SIGHUP para shutdown graceful
#          (la imagen base NO lo trae)
# install-php-extensions compila contra los headers ZTS de esta misma imagen
RUN install-php-extensions ffi intl zip pcntl

# Habilitar FFI en runtime (default: "preload", sólo permite FFI en preload).
# libsql/turso requiere FFI en runtime, ver CLAUDE.md.
RUN { \
        echo '; Habilitar FFI para turso/libsql'; \
        echo 'ffi.enable=true'; \
    } > /usr/local/etc/php/conf.d/zz-ffi.ini

# Composer (imagen oficial, multi-stage copy)
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

WORKDIR /app

# 1) Manifiestos primero → cache de capa vendor
COPY composer.json composer.lock ./
RUN composer install \
        --no-dev \
        --no-scripts \
        --no-autoloader \
        --prefer-dist \
        --no-interaction \
        --no-progress

# 2) Resto del código
COPY . .

# 3) Autoloader optimizado + scripts post-autoload-dump (package:discover, filament:upgrade)
RUN composer dump-autoload --optimize --classmap-authoritative --no-dev \
    && php artisan octane:install --server=frankenphp --no-interaction

# Permisos storage y bootstrap/cache (FrankenPHP corre como root por defecto, pero
# las rutas web puede querer www-data si se monta en un proxy con ese usuario)
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

EXPOSE 8000

# Octane: 4 workers, reciclar cada 1000 requests para evitar fugas de FFI
# El entrypoint se encarga de generar/persistir APP_KEY antes de esto.
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php", "artisan", "octane:start", \
     "--server=frankenphp", \
     "--host=0.0.0.0", \
     "--port=8000", \
     "--workers=4", \
     "--max-requests=1000", \
     "--task-workers=2"]
