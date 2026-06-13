#!/bin/sh
#
# bitets-api container entrypoint.
#
# Garantiza que .env exista (copiando .env.example si hace falta) y que
# APP_KEY esté configurada antes de iniciar Octane. Si APP_KEY viene del
# entorno del container tiene prioridad.

set -eu

cd /app

# 1) .env: copia desde .env.example si no existe
if [ ! -f .env ] && [ -f .env.example ]; then
    cp .env.example .env
    echo "[entrypoint] .env creado desde .env.example"
fi

# 2) APP_KEY: prioriza env del container; si no, autogenera y persiste en .env
if [ -n "${APP_KEY:-}" ]; then
    echo "[entrypoint] APP_KEY provista por entorno (${#APP_KEY} chars)"
elif ! grep -qE '^APP_KEY=base64:.+' .env 2>/dev/null; then
    echo "[entrypoint] APP_KEY no provista: generando una nueva"
    php artisan key:generate --force
fi

exec "$@"
