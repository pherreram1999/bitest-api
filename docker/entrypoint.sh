#!/bin/sh
#
# bitets-api container entrypoint.
#
# Garantiza que APP_KEY esté disponible antes de iniciar Octane.
# Orden de precedencia:
#   1) APP_KEY en el entorno del container (--env-file, -e, docker-compose env)
#   2) /app/storage/app.key (volume persistente: sobrevive reinicios)
#   3) Genera una nueva con `php artisan key:generate` y la persiste en
#      /app/storage/app.key (solo la primera vez)
#
# Notas:
# - Si APP_KEY cambia entre reinicios, todos los datos cifrados
#   (sesiones, cookies, tokens de Sanctum) quedan inaccesibles.
#   Por eso se persiste en un archivo de storage (típico volume).
# - En producción real (multi-replica) usa un secret manager y pasa
#   APP_KEY vía env; no confíes en el filesystem local.

set -eu

APP_KEY_FILE="${APP_KEY_FILE:-/app/storage/app.key}"

# 1) APP_KEY en env → úsala tal cual
if [ -n "${APP_KEY:-}" ]; then
    echo "[entrypoint] APP_KEY provista por entorno (${#APP_KEY} chars)"
else
    # 2) ¿Existe clave persistida en storage?
    if [ -f "$APP_KEY_FILE" ]; then
        APP_KEY="$(cat "$APP_KEY_FILE")"
        export APP_KEY
        echo "[entrypoint] APP_KEY cargada desde $APP_KEY_FILE"
    else
        # 3) Generar nueva clave
        echo "[entrypoint] APP_KEY no provista: generando una nueva"
        # `key:generate --force` regenera .env, no queremos eso.
        # `--show` imprime la clave sin tocar .env; la capturamos y persistimos.
        APP_KEY="$(php artisan key:generate --show --force 2>/dev/null)"

        if [ -z "$APP_KEY" ]; then
            echo "[entrypoint] ERROR: no se pudo generar APP_KEY" >&2
            exit 1
        fi

        export APP_KEY

        # Persistir para próximos reinicios
        mkdir -p "$(dirname "$APP_KEY_FILE")"
        printf '%s' "$APP_KEY" > "$APP_KEY_FILE"
        chmod 600 "$APP_KEY_FILE" || true
        echo "[entrypoint] APP_KEY persistida en $APP_KEY_FILE"
    fi
fi

# Re-generar APP_KEY en el .env del container solo si difiere (idempotente).
# Esto evita que Laravel caiga en fallback si algo más lee del .env.
if [ -f /app/.env ]; then
    if ! grep -q "^APP_KEY=" /app/.env 2>/dev/null; then
        echo "APP_KEY=$APP_KEY" >> /app/.env
    elif ! grep -q "^APP_KEY=$APP_KEY" /app/.env 2>/dev/null; then
        # Reemplazar la línea APP_KEY existente
        if command -v sed >/dev/null 2>&1; then
            sed -i.bak "s|^APP_KEY=.*|APP_KEY=$APP_KEY|" /app/.env
            rm -f /app/.env.bak
        fi
    fi
fi

echo "[entrypoint] APP_KEY lista (${#APP_KEY} chars)"

# Ejecutar el comando original (CMD del Dockerfile o lo pasado al `docker run`)
exec "$@"
