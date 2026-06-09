#!/usr/bin/env sh
set -eu

require_env() {
    name="$1"
    value="$(printenv "$name" || true)"

    if [ -z "$value" ]; then
        echo "Missing required environment variable: $name" >&2
        exit 1
    fi
}

require_env APP_KEY

export DB_CONNECTION="${DB_CONNECTION:-mysql}"
export DB_HOST="${DB_HOST:-${MYSQLHOST:-}}"
export DB_PORT="${DB_PORT:-${MYSQLPORT:-}}"
export DB_DATABASE="${DB_DATABASE:-${MYSQLDATABASE:-}}"
export DB_USERNAME="${DB_USERNAME:-${MYSQLUSER:-}}"
export DB_PASSWORD="${DB_PASSWORD:-${MYSQLPASSWORD:-}}"

if [ -z "$(printenv APP_URL || true)" ]; then
    echo "APP_URL is not set; Laravel will use its default URL." >&2
fi

if [ "$DB_CONNECTION" = "mysql" ] && [ -z "$(printenv DB_URL || true)" ] && [ -z "$(printenv DATABASE_URL || true)" ]; then
    require_env DB_HOST
    require_env DB_PORT
    require_env DB_DATABASE
    require_env DB_USERNAME
    require_env DB_PASSWORD
fi

php artisan optimize:clear
php artisan migrate --force || echo "Migration failed; starting web server so Railway healthcheck can run." >&2
php artisan storage:link || true
php artisan config:cache
php artisan route:cache
php artisan view:cache

exec php artisan serve --host=0.0.0.0 --port="${PORT:-8080}"
